<?php namespace TT\Academic\Store\Domain;

use Input;

use Sentry;

use DB;

use CSV;

use Exception;

use TT\Support\AcademicHelper;
use TT\Support\AbstractService;

use TT\Academic\AcademicFormFactory;

use Aura\Payload\PayloadFactory;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use TT\Student\StudentRepository;

use TT\Student\StudentTraitRepository;

use TT\Teacher\TeacherRepository;

class StoreService extends AbstractService
{
    public function __construct(
                                AcademicFormFactory $academicFormFactory, 
                                PayloadFactory $payload_factory, 
                                StudentRepository $studentRepository, 
                                StudentTraitRepository $studentTraitRepository,
                                TeacherRepository $teacherRepository)
    {
        $this->academicFormFactory = $academicFormFactory;
        $this->payload_factory = $payload_factory;
        $this->studentRepository = $studentRepository;
        $this->studentTraitRepository = $studentTraitRepository;
        $this->teacherRepository = $teacherRepository;
    }

    public function store($input)
    {
        try
        {
            $form = $this->academicFormFactory->newAcademicStoreForm();
            $payload = null;
            $output = [];

            if( ! $form->isValid($input) )
            {
                $messages = $form->getErrors();

                $payload = $this->not_accepted(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-danger m-t']]]);
            }

            else
            {
                $payload = $this->uploadAcademic($input['academic']);
                
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

    private function uploadAcademic(UploadedFile $file)
    {
        try
        {
            DB::beginTransaction();
            
            $path = $file->getRealPath();
			$csv = CSV::parse($path);
			$data = $csv->lines();				

            
            $studentAceCodes = DB::table('students_traits')->lists('student_id','ace_code');
            $studentCreateGoals = array();
            $studentUpdateGoals = array();
			
                            
            for($i = 1; $i < count($data); $i++)
                    {
				$values = $data[$i];
						
  				$aceCode = isset($values['7']) ? $values[7] : null;

																		
				$studentId = isset($studentAceCodes[$aceCode]) ? intval($studentAceCodes[$aceCode]) : null;
														
				$grade = isset($values['2']) ? $values[2] : null;
				$percentage = isset($values['3']) ? $values[3] : null;
				$course = isset($values['4']) ? $values[4] : null;
				$teacher = isset($values['5']) ? $values[5] : null;		
				$date = isset($values['6']) ? strtotime($values[6]) : null;	

				$last_update = date('Y-m-d',$date);		
						
						//$studentAcademicGoals = DB::table('academic_goals')->where('student_id','=',$studentId)->get();

                       // $studentHasGoal = false;
						
				if(! is_null($studentId)){
//dd($studentId);		
                        //foreach($studentAcademicGoals as $studentAcademicGoal) {
                       	//	if( intval($studentAcademicGoal->student_id) === $studentId) {
                              //      $studentHasGoal = true;
                         //           break;
                         //       }
                           // }
		
							

                          //  if( ! $studentHasGoal )
                $studentCreateGoals[] = ['student_id'=>$studentId,'grade'=>$grade,'percentage'=>$percentage,'course'=>$course,'teacher_name'=>$teacher,'last_update'=>$last_update];
                           // else
                           //     $studentUpdateGoals[] = ['student_id'=>$studentId,'grade'=>$grade,'percentage'=>$percentage,'course'=>$course,'teacher_name'=>$teacher];
                        
                }
			}
            
            
			if( count($studentCreateGoals) > 0 ){
	
				DB::table('academic_goals')->truncate();
			
                DB::table('academic_goals')->insert($studentCreateGoals);
			}
            
           /* if( count($studentUpdateGoals) > 0 ) {

                foreach($studentUpdateGoals as $studentUpdateGoal)
                {
                    $studentId = $studentUpdateGoal['student_id'];                    
                    
                    //REALLY INEFFICIENT
                    DB::table('academic_goals')->where('student_id','=',$studentId)->update($studentUpdateGoal);
                }
            }*/

            DB::commit();
            
            $messages = [$this->getMsg('messages.academic_goals_upload')];
            $payload = $this->success(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-success m-t']]]);

            return $payload;
        }

        catch(Exception $e)
        {
            return $this->error($e);
        }
    }
}
