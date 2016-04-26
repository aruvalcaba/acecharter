<?php namespace TT\Home\Parent\Domain;

use DB;

use Sentry;

use TT\Support\GoalHelper;

use TT\Support\AbstractService;

use TT\Service\ActivityService;

use Aura\Payload\PayloadFactory;

class HomeService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory, ActivityService $activity_service) {
        $this->activity_service = $activity_service;
        $this->payload_factory = $payload_factory;
    }

    public function home() {
        try {
            $payload = $this->success();

            if( Sentry::check() ) {
                $output = $payload->getOutput();
                $user = Sentry::getUser();

				$students = $user->students;
				//dd($students);

                $studentIds = array();

                foreach($students as $student) 
                {
                    $studentIds[] = $student->id;
                }
				//dd($studentIds);

				$studentGoals = DB::table('students_goals')->whereIn('student_id',$studentIds)->select(['student_id','goal_id','value','updated_at'])->get();
                $studentGoalsFlat = array();
				//dd($studentGoals);

                foreach($studentGoals as $studentGoal)
                {
                    $studentGoalsFlat[$studentGoal->student_id][$studentGoal->goal_id] = $studentGoal->value; 
					$studentGoalsFlat[$studentGoal->student_id]['updated_at'] = $studentGoal->updated_at; 
                }
				
				foreach($students as $student)
                {
                    
					$studentGoals = isset($studentGoalsFlat[$student->id]) ? $studentGoalsFlat[$student->id] : [];
			
                    $student->goals = $studentGoals;
                }

				//get goals
				$goals = DB::table('goals')->get();

                foreach($goals as $goal) 
                {
                    $goal->name_unformat = GoalHelper::unformat($goal->name);
                }


                $output['user'] = $user;
                $output['acts'] = $this->activity_service->getActivities($user);
				$output['avg'] = $this->activity_service->getAvgActivityTime();
				$output['data'] = $this->getData();
				$output['students'] = ! empty($students) ? $students : [];
                $output['student'] = $user->students()->first();
				$output['goals'] = $goals;
                $payload->setOutput($output);
            }
            
            return $payload;
        }

        catch(Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getData() {
		$user = Sentry::getUser();
		$student = $user->students()->first();
		$name = $student->first_name;
        
        return [
				'welcome' => ['val'=>$this->getMsg('constants.welcome')],
				'changed_pwd' => $this->getMsg('constants.change_password'),
				'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
				'parents' => ['val'=>$this->getMsg('constants.parents')],
				'teachers' => ['val'=>$this->getMsg('constants.teachers')],
				'logout' => $this->getMsg('constants.logout'),
				'invitation' => ['val'=>$this->getMsg('constants.invitation')],
				'invitation_conference' => ['val'=>$this->getMsg('messages.invitation_conference')],
				'view' => ['val'=>$this->getMsg('constants.view')],
				'progress_report' => ['val' => $this->getMsg('constants.progress_report')],
				'daily_attendance' => ['val' => $this->getMsg('constants.daily_attendance')],
				'daily_homework' => ['val' => $this->getMsg('constants.daily_homework')],
				'positive_behavior' => ['val' => $this->getMsg('constants.positive_behavior')],
				'growth_mindset' => ['val' => $this->getMsg('constant.growth_mindset')],
				'academic_success' => ['val' => $this->getMsg('constants.academic_success')],
				'academic_achievement_ela' => ['val' => $this->getMsg('constants.academic_achievement_ela')],
				'academic_achievement_math' => ['val' => $this->getMsg('constants.academic_achievement_math')],
				'ela_proficiency' => ['val' => $this->getMsg('constants.ela_proficiency')],
				'math_proficiency' => ['val' => $this->getmsg('constants.math_proficiency')],
				'punctuality' => ['val' => $this->getMsg('constants.punctuality')],
				'ok' => ['type'=>'button','name'=>'ok','value'=>$this->getMsg('constants.ok'),'attribs'=>['class'=>'btn btn-success','data-dismiss'=>'modal']],
				'more' => ['type'=>'button','name'=>'more','value'=>$this->getMsg('constants.more'),'attribs'=>['class'=>'btn btn-info']],
				'positive_behavior_1' => $this->getMsg('goals.positive_behavior_positive',['name'=>$name]),
				'positive_behavior_0' => $this->getMsg('goals.positive_behavior_negative',['name'=>$name]),
				'daily_attendance_1' => $this->getMsg('goals.daily_attendance_positive',['name'=>$name]),
				'daily_attendance_0' => $this->getMsg('goals.daily_attendance_negative',['name'=>$name]),
				'daily_homework_1' => $this->getMsg('goals.daily_homework_positive',['name'=>$name]),
				'daily_homework_0' => $this->getMsg('goals.daily_homework_negative',['name'=>$name]),
				'academic_success_1' => $this->getMsg('goals.academic_success_positive',['name'=>$name]),
				'academic_success_0' => $this->getMsg('goals.academic_success_negative',['name'=>$name]),
				'footer_msg' => $this->GetMsg('messages.footer_msg'),
				'footer_here' => $this->GetMsg('messages.footer_here'),
				'addChild_btn' => ['type'=>'button','name'=>'addChild','value'=>$this->getMsg('constants.add_child'),'attribs'=>['id'=>'addChild','class'=>'btn btn-skin','data-toggle'=>'modal','data-target'=>'#addChildModal']],
				'add_child' => ['val' => $this->getMsg('constants.add_child')],
				'cancel_btn' => ['type'=>'button', 'name'=>'cancel', 'value'=>$this->getMsg('constants.cancel'),'attribs'=>['class'=>'btn btn-default','data-dismiss'=>'modal']],
				'child_btn' => ['type'=>'button', 'name'=>'add_child', 'value'=>$this->getMsg('constants.add_child'),'attribs'=>['class'=>'btn btn-success','id'=>'add_child']],
				'student' => ['val'=>$this->getMsg('constants.student')],					
				'code' => ['val'=>$this->getMsg('constants.code')],	
				'student_code_input' => ['type'=>'text','name'=>'student_code','attribs'=>['maxlength'=>'6','class'=>'form-control','id'=>'student_code','placeholder'=>$this->getMsg('messages.student_code_placeholder')]],
				'studentCodeText' => ['val'=>$this->getMsg('messages.student_code_text')],
				'data_updated' => ['val' => $this->getMsg('messages.data_updated')],

	];

    }
}
