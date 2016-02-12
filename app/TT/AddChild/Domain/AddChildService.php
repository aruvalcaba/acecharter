<?php namespace TT\AddChild\Domain;

use DB;

use Sentry;

use TT\Service\ParentService;

use Aura\Payload\PayloadFactory;

use TT\AddChild\AddChildForm;

use TT\Support\AbstractService;

use Aura\Payload_Interface\PayloadStatus;

class AddChildService extends AbstractService {
    public function __construct( ParentService $parent_service, AddChildForm $form_factory,PayloadFactory $payload_factory ) {
        $this->parent_service = $parent_service;
		$this->AddChildForm = $form_factory;
        $this->payload_factory = $payload_factory;
    }

    public function addChild(array $input) {

	
		
		    $form = new $this->AddChildForm;
		    $payload = $this->payload_factory->newInstance();
			$studentCode = $input['student_code'];
			$parent = Sentry::getUser();

		    if( ! $form->isValid($input) ) {
		        $messages = $form->getErrors();
		        
		        $payload->setStatus(PayloadStatus::NOT_VALID);
		        $payload->setOutput(['response'=>['messages'=>$messages]]);

		    }

		    else {
				//get student ID from ace code
				$studentTrait = DB::table('students_traits')->where('ace_code',$studentCode)->select(['student_id'])->first();
			
				$studentId = $studentTrait->student_id;

				//check if student already associated with parent?

				$child = DB::table('parents_students')->where('student_id',$studentId)->select(['parent_id'])->first();

				if(count($child)){
					$payload->setStatus(PayloadStatus::NOT_CREATED);
		            $messages = [$this->getMsg('messages.add_child_exist')];
		            $payload->setOutput(['response'=>['messages'=>$messages]]); 
				}
				else {
				
					$addChild = DB::table('parents_students')->insert(['parent_id'=> $parent->id,'student_id'=> $studentId,'relationship'=>'']);		

				    if($addChild) {				
				        $payload->setStatus(PayloadStatus::SUCCESS);
				        $messages = [$this->getMsg('messages.add_child_success')];					
                		$payload->setOutput(
									[
										'response'=>['messages'=>$messages],
										'alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-success m-t']]]
									);

							           
				    }
				    else {
				        $payload->setStatus(PayloadStatus::NOT_CREATED);
				        $messages = [$this->getMsg('messages.add_child_fail')];
				        $payload->setOutput(['response'=>['messages'=>$messages]]);  
				    }
				}
		    }		

        	return $payload;
		
    }

    public function getData() {
        return [];
    }
}
