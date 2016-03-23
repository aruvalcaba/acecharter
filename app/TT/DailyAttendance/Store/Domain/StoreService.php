<?php namespace TT\DailyAttendance\Store\Domain;

use Input;

use Sentry;

use DB;

use CSV;

use Exception;

//use TT\Support\AcademicHelper;
use TT\Support\AbstractService;

use TT\DailyAttendance\DailyAttendanceFormFactory;

use Aura\Payload\PayloadFactory;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use TT\Student\StudentRepository;

use TT\Student\StudentTraitRepository;

class StoreService extends AbstractService
{
    public function __construct(
                                DailyAttendanceFormFactory $dailyAttendanceFormFactory, 
                                PayloadFactory $payload_factory, 
                                StudentRepository $studentRepository, 
                                StudentTraitRepository $studentTraitRepository)
    {
        $this->dailyAttendanceFormFactory = $dailyAttendanceFormFactory;
        $this->payload_factory = $payload_factory;
        $this->studentRepository = $studentRepository;
        $this->studentTraitRepository = $studentTraitRepository;
    }

    public function store($input)
    {
        try
        {
            $form = $this->dailyAttendanceFormFactory->newDailyAttendanceStoreForm();
            $payload = null;
            $output = [];

            if( ! $form->isValid($input) )
            {
                $messages = $form->getErrors();

                $payload = $this->not_accepted(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-danger m-t']]]);
            }

            else
            {
                $payload = $this->uploadDailyAttendance($input['daily_attendance']);
                
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

    private function uploadDailyAttendance(UploadedFile $file)
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
						
  				$aceCode = isset($values['0']) ? $values[0] : null;
																		
				$studentId = isset($studentAceCodes[$aceCode]) ? intval($studentAceCodes[$aceCode]) : null;
														
				$schoolId = isset($values['1']) ? intval($values[1]) : null;
				$attendance = isset($values['2']) ? intval($values[2]) : null;
				$tardy = isset($values['3']) ? intval($values[3]) : null;
									
						
						
				if(! is_null($studentId)){
                	$studentCreateGoals[] = ['student_id'=>$studentId,'school_id'=>$schoolId,'attendance'=>$attendance,'tardy'=>$tardy];                          
                        
                }
			}
            
            
			if( count($studentCreateGoals) > 0 ){
	
				DB::table('daily_attendance_goals')->truncate();
			
                DB::table('daily_attendance_goals')->insert($studentCreateGoals);
			}
            
           
            DB::commit();
            
            $messages = [$this->getMsg('messages.daily_attendance_goals_upload')];
            $payload = $this->success(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-success m-t']]]);

            return $payload;
        }

        catch(Exception $e)
        {
            return $this->error($e);
        }
    }
}
