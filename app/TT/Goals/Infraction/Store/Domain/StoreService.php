<?php namespace TT\Goals\Infraction\Store\Domain;

use Input;

use Sentry;

use DB;

use CSV;

use Exception;

use TT\Support\AbstractService;

use TT\Goals\Infraction\InfractionFormFactory;

use Aura\Payload\PayloadFactory;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use TT\Student\StudentRepository;

use TT\Student\StudentTraitRepository;

class StoreService extends AbstractService
{
    public function __construct(
                                InfractionFormFactory $infractionFormFactory, 
                                PayloadFactory $payload_factory, 
                                StudentRepository $studentRepository, 
                                StudentTraitRepository $studentTraitRepository)
    {
        $this->infractionFormFactory = $infractionFormFactory;
        $this->payload_factory = $payload_factory;
        $this->studentRepository = $studentRepository;
        $this->studentTraitRepository = $studentTraitRepository;
    }

    public function store($input)
    {
        try
        {
            $form = $this->infractionFormFactory->newInfractionStoreForm();
            $payload = null;
            $output = [];

            if( ! $form->isValid($input) )
            {
                $messages = $form->getErrors();

                $payload = $this->not_accepted(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-danger m-t']]]);
            }

            else
            {
                $payload = $this->uploadInfraction($input['infraction']);
                
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

    private function uploadInfraction(UploadedFile $file)
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
														
				$typeOfInfraction = isset($values['1']) ? $values[1] : null;
				$date = isset($values['2']) ? strtotime($values[2]) : null;
				$staff = isset($values['3']) ? $values[3] : null;
				$comments = isset($values['4']) ? $values[4] : null;

				$date = date('Y-m-d',$date);						
						
						
				if(! is_null($studentId)){
                	$studentCreateGoals[] = ['student_id'=>$studentId,'type_of_infraction'=>$typeOfInfraction,'date_of_infraction'=>$date,'staff_name'=>$staff,'comments'=>$comments];                          
                        
                }
			}
            
            
			if( count($studentCreateGoals) > 0 ){
	
				DB::table('infractions_goals')->truncate();
			
                DB::table('infractions_goals')->insert($studentCreateGoals);
			}
            
           
            DB::commit();
            
            $messages = [$this->getMsg('messages.infractions_goals_upload')];
            $payload = $this->success(['alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-success m-t']]]);

            return $payload;
        }

        catch(Exception $e)
        {
            return $this->error($e);
        }
    }
}
