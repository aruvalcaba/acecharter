<?php namespace TT\Home\Teacher\Domain;

use DB;

use Sentry;

use TT\Support\GoalHelper;
use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

class HomeService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory) {
        $this->payload_factory = $payload_factory;
    }

    public function home() {
        try {
            $payload = $this->success();

            if( Sentry::check() ) {
                $output = $payload->getOutput();
                
                $user = Sentry::getUser();
                $students = $user->students;

                $studentIds = array();

                foreach($students as $student) 
                {
                    $studentIds[] = $student->id;
                }

                $aceCodes = DB::table('students_traits')->whereIn('student_id',$studentIds)->lists('ace_code','student_id');
                $studentGoals = DB::table('students_goals')->whereIn('student_id',$studentIds)->select(['student_id','goal_id','value'])->get();
                $studentGoalsFlat = array();

                foreach($studentGoals as $studentGoal)
                {
                    $studentGoalsFlat[$studentGoal->student_id][$studentGoal->goal_id] = $studentGoal->value; 
                }

                foreach($students as $student)
                {
                    $student->ace_code = $aceCodes[$student->id];

		    $studentGoals = isset($studentGoalsFlat[$student->id]) ? $studentGoalsFlat[$student->id] : [];


			
                    $student->goals = $studentGoals;
                }

                $goals = DB::table('goals')->get();

                foreach($goals as $goal) 
                {
                    $goal->name = GoalHelper::unformat($goal->name);
                }

                $output['user'] = $user;
                $output['students'] = ! empty($students) ? $students : [];
                $output['data'] = $this->getData();
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
        return [
                'register_btn'=>['type'=>'button','name'=>'register_btn','value'=>$this->getMsg('constants.registration'),'attribs'=>['id'=>'register_btn','class'=>'btn btn-default active']],
                'all_students_btn'=>['type'=>'button','name'=>'all_students_btn','value'=>$this->getMsg('constants.all_students'),'attribs'=>['id'=>'all_students_btn','class'=>'btn btn-default']],
                'how_register_parents'=>$this->getMsg('constants.how_register_parents'),
				'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
				'parent' => ['val'=>$this->getMsg('constants.parent')],
				'teachers' => ['val'=>$this->getMsg('constants.teachers')]	,
				'changed_pwd' => $this->getMsg('constants.change_password'),
				'logout' => $this->getMsg('constants.logout')
               ];
    }
}
