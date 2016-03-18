<?php namespace TT\Goals\Domain;

use DB;

use Sentry;

use Request;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

use TT\Support\AbstractService;

use Aura\Payload\Payload;



class GoalsService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory ) {
        $this->payload_factory = $payload_factory;
    }

    public function goal($id) {
        $payload = $this->payload_factory->newInstance();

		if($id!=="") { 

			//get goals
			$goal = DB::table('goals')->where('id','=',$id)->get();            

			$output['goal_id'] = $id; 

			$selectedStudentId = Request::input('studentid');			
          
            $payload->setStatus(PayloadStatus::SUCCESS);
			 if(Sentry::check() ) {
					$user = Sentry::getUser();
					$students = $user->students;
					
					$studentId = isset($selectedStudentId) ? $selectedStudentId : $students[0]->id;

					$studentGoal = DB::table('students_goals')->where('student_id',$studentId)->where('goal_id',$id)->select(['student_id','goal_id','value'])->get();

					

					$output['goal'] = $studentGoal[0]->value;

					
                    $output['user'] = $user;
                }
				
			$output['data'] = $this->getData();
            $payload->setOutput($output);
            return $payload;
		}
		
          
    }

    public function getData() {
		
		//get selected student name 
		$selectedStudentId = Request::input('studentid');		
		$student = DB::table('users')->where('id',$selectedStudentId)->select(['first_name'])->get();
		$name = $student[0]->first_name;
        return [
				'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
				'parents' => ['val'=>$this->getMsg('constants.parents')],
				'teachers' => ['val'=>$this->getMsg('constants.teachers')],
				'changed_pwd' => $this->getMsg('constants.change_password'),
				'logout' => $this->getMsg('constants.logout'),
				'goal_1_intro' => $this->getMsg('goals.goal_1_intro'),
				'goal_1_positive' => $this->getMsg('goals.goal_1_positive',['name'=> $name]),
				'goal_1_negative' => $this->GetMsg('goals.goal_1_negative',['name'=>$name]),
				'goal_2_intro' => $this->getMsg('goals.goal_2_intro'),
				'goal_2_positive' => $this->getMsg('goals.goal_2_positive',['name'=>$name]),
				'goal_2_negative' => $this->GetMsg('goals.goal_2_negative',['name'=>'Neeru']),				
				'goal_3_intro' => $this->getMsg('goals.goal_3_intro'),
				'goal_3_positive' => $this->getMsg('goals.goal_3_positive',['name'=>$name]),
				'goal_3_negative' => $this->GetMsg('goals.goal_3_negative',['name'=>$name]),
				'goal_4_intro' => $this->getMsg('goals.goal_4_intro'),				
				'goal_4_positive' => $this->getMsg('goals.goal_4_positive',['name'=>$name]),
				'goal_4_negative' => $this->GetMsg('goals.goal_4_negative',['name'=>$name]),
				'progress_report' => ['val' => $this->getMsg('constants.progress_report')],
				'daily_attendance' => ['val' => $this->getMsg('constants.daily_attendance')],
				'daily_homework' => ['val' => $this->getMsg('constants.daily_homework')],
				'positive_behavior' => ['val' => $this->getMsg('constants.positive_behavior')],
				'punctuality' => ['val' => $this->getMsg('constants.punctuality')],
				'academic_success' => ['val' => $this->getMsg('constants.academic_success')],
				'footer_msg' => $this->GetMsg('messages.footer_msg'),
				'footer_here' => $this->GetMsg('messages.footer_here'),
            ];
    }
}

?>
