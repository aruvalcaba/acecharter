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
                $payload = $this->uploadGoals($input['goals']);
                
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
			
			//for goal names only
            for($i = 1; $i < 5; $i++) {
                $goalsNames[] = GoalHelper::format($data[$i]);
            }
			//for all goal data
			for($i = 1; $i < count($data); $i++) {
                $goals[] = GoalHelper::format($data[$i]);
            }			

            $goalsMap = DB::table('goals')->lists('id','name');

            $goalsMapKeys = array_keys($goalsMap);
            
            //Find goals to add to goals table
            $newGoals = array_diff($goalsNames,$goalsMapKeys);
            $newGoals = array_values($newGoals);

			// comment - no future change in goal table

            /*if( count($newGoals) > 0 )
            {
                foreach($newGoals as &$newGoal)
                {
                    $goalName = $newGoal;

                    $newGoal = array('name'=>$goalName);
                }

                DB::table('goals')->insert($newGoals);
                $goalsMap = DB::table('goals')->lists('id','name');
            }
			*/

            $studentAceCodes = DB::table('students_traits')->lists('student_id','ace_code');
            $studentCreateGoals = array();
            $studentUpdateGoals = array();
			$updated_at = date("Y-m-d H:i:s");
			//dd($updated_at);

            while( !feof($fileHandle) )
            {
                $data = fgetcsv($fileHandle);

                $aceCode = $data[0];

				
				
                $studentId = isset($studentAceCodes[$aceCode]) ? intval($studentAceCodes[$aceCode]) : null;
                $studentGoals = DB::table('students_goals')->where('student_id','=',$studentId)->get();
				
                if( ! is_null($studentId) ) {
                
                    for($i = 1; $i < count($data); $i++)
                    {
                        $goal = $goals[$i-1];

                        if( isset($goalsMap[$goal]) && isset($studentAceCodes[$aceCode]) ) {

                            $goalId = intval($goalsMap[$goal]);
                            $value = $data[$i];
                        
                            $studentHasGoal = false;

                            foreach($studentGoals as $studentGoal) {
                                if( intval($studentGoal->goal_id) === $goalId) {
                                    $studentHasGoal = true;
                                    break;
                                }
                            }

							

                            if( ! $studentHasGoal )
                                $studentCreateGoals[] = ['goal_id'=>$goalId,'student_id'=>$studentId,'value'=>$value,'updated_at' => $updated_at];
                            else
                                $studentUpdateGoals[] = ['goal_id'=>$goalId,'student_id'=>$studentId,'value'=>$value,'updated_at' => $updated_at];
                        }
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
                    DB::table('students_goals')->where('student_id','=',$studentId)->where('goal_id','=',$goalId)->update($studentUpdateGoal);
                }
            }

            DB::commit();
            
            $messages = [$this->getMsg('messages.goals_upload')];
            $payload = $this->success(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-success m-t']]]);

            return $payload;
        }

        catch(Exception $e)
        {
            return $this->error($e);
        }
    }
}
