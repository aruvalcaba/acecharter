<?php namespace TT\Goals\Store\Domain;

use Input;

use Sentry;

use DB;

use CSV;

use Exception;

use TT\Support\GoalHelper;
use TT\Support\AbstractService;

use TT\Goals\GoalsFormFactory;

use Aura\Payload\PayloadFactory;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use TT\Student\StudentRepository;

use TT\Student\StudentTraitRepository;

use TT\Teacher\TeacherRepository;

class StoreService extends AbstractService
{
    public function __construct(
                                GoalsFormFactory $goalsFormFactory, 
                                PayloadFactory $payload_factory, 
                                StudentRepository $studentRepository, 
                                StudentTraitRepository $studentTraitRepository,
                                TeacherRepository $teacherRepository)
    {
        $this->goalsFormFactory = $goalsFormFactory;
        $this->payload_factory = $payload_factory;
        $this->studentRepository = $studentRepository;
        $this->studentTraitRepository = $studentTraitRepository;
        $this->teacherRepository = $teacherRepository;
    }

    public function store($input)
    {
        try
        {
            $form = $this->goalsFormFactory->newGoalsStoreForm();
            $payload = null;
            $output = [];

            if( ! $form->isValid($input) )
            {
                $messages = $form->getErrors();

                $payload = $this->not_accepted(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-danger m-t']]]);
            }

            else
            {
                $uploaded = $this->uploadGoals($input['goals']);
                
                if( $uploaded ) {
                    $messages = [$this->getMsg('messages.goals_upload')];
                    $payload = $this->success(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-success m-t']]]);
                }

                else {
                    $messages = [$this->getMsg('messages.goals_not_upload')];
                    $payload = $this->error(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-danger m-t']]]);
                }
            }
            
            $payload->getOutput()['user'] = Sentry::getUser();

            return $payload;
       }

        catch(Exception $e)
        {
            return $this->error($e);
        }
    }

    public function getData()
    {
        return [
               ];
    }

    private function uploadGoals(UploadedFile $file)
    {
        try
        {
            DB::beginTransaction();
            
            $path = $file->getRealPath();
           
            $goals = array();

            $fileHandle = fopen($path,'r');
            $data = fgetcsv($fileHandle); //skip first line

            for($i = 1; $i < count($data); $i++) {
                $goals[] = GoalHelper::format($data[$i]);
            }

            $goalsMap = DB::table('goals')->lists('id','name');

            $goalsMapKeys = array_keys($goalsMap);
            
            //Check diff, if count > 0, then our csv has too many or too
            //few valid goals
            $diff = array_diff($goals,$goalsMapKeys);
            if( count($diff) > 0 )
            {
                return false;
            }

            $studentAceCodes = DB::table('students_traits')->lists('student_id','ace_code');
            $studentCreateGoals = array();
            $studentUpdateGoals = array();
            $studentGoals = DB::table('students_goals')->lists('id','student_id');

            while( !feof($fileHandle) )
            {
                $data = fgetcsv($fileHandle);

                $aceCode = $data[0];

                for($i = 1; $i < count($data); $i++)
                {
                    $goal = $goals[$i-1];

                    if( isset($goalsMap[$goal]) && isset($studentAceCodes[$aceCode]) ) {

                        $goalId = intval($goalsMap[$goal]);
                        $studentId = intval($studentAceCodes[$aceCode]);
                        $value = $data[$i];

                        if( ! isset($studentGoals[$studentId]) )
                            $studentCreateGoals[] = ['goal_id'=>$goalId,'student_id'=>$studentId,'value'=>$value];
                        else
                            $studentUpdateGoals[] = ['goal_id'=>$goalId,'student_id'=>$studentId,'value'=>$value];
                    }

                }
            }
            
            fclose($fileHandle);
            if( count($studentCreateGoals) > 0 ) 
                DB::table('students_goals')->insert($studentCreateGoals);
            
            if( count($studentUpdateGoals) > 0 ) {

                foreach($studentUpdateGoals as $studentUpdateGoal)
                {
                    $studentId = $studentUpdateGoal['student_id'];
                    $goalId = $studentUpdateGoal['goal_id'];
                    
                    //REALLY INEFFICIENT
                    DB::table('students_goals')->where('student_id','=',$studentId)->update($studentUpdateGoal);
                }
            }

            DB::commit();

            return true;
        }

        catch(Exception $e)
        {
            DB::rollback();
            return false;
        }
    }
}
