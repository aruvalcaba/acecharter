<?php namespace TT\Home\Teacher\Domain;

use Sentry;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

use Faker\Factory as FakerFactory;

class HomeService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory) {
        $this->payload_factory = $payload_factory;
		$this->faker = FakerFactory::create();
    }

    public function home() {
        try {
            $payload = $this->success();

            if( Sentry::check() ) {
                $output = $payload->getOutput();
                
                $user = Sentry::getUser();
                $students = $this->getFakeStudents();

                $output['user'] = $user;
                $output['students'] = ! empty($students) ? $students : [];
                $output['data'] = $this->getData();
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

	public function getFakeStudents() {
        $students = [];
        for($i = 0; $i < 25; $i++) {
            $student = new \stdClass();
            $student->fullname = $this->faker->name;
            $student->parentName = $this->faker->name;
            $student->last_login = $this->faker->dateTimeThisMonth->format('Y-m-d');
            $student->code = $this->faker->randomNumber(6);
            $student->goal1 = $this->faker->randomElement(array(0,1));
            $student->goal2 = $this->faker->randomElement(array(0,1));
            $students[] = $student;
        }
        return $students;
    }
}
