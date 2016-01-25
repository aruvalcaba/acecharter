<?php

use TT\Parent\ParentRepository;
use TT\Student\StudentRepository;
use TT\Teacher\TeacherRepository;
use TT\Teacher\TeacherTraitRepository;

class UserSeeder extends Seeder {
    

    public function __construct(
                        ParentRepository $parentRepository,
                        StudentRepository $studentRepository,
                        TeacherRepository $teacherRepository,
                        TeacherTraitRepository $teacherTraitRepository)
    {
        $this->parentRepository = $parentRepository;
        $this->studentRepository = $studentRepository;
        $this->teacherRepository = $teacherRepository;
        $this->teacherTraitRepository = $teacherTraitRepository;
    }

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
        $this->command->info('Importing users...');
        
        $admin = Sentry::register([
                                    'first_name'=>'Admin',
                                    'email'=>'admin@acecharter.org',
                                    'password'=>'admin',
                                    'activated'=>1,
                                    'traits_type'=>'TT\Models\AdminTrait'
                                    ]);
        
        $adminGroup = Sentry::findGroupByName('Admin'); 
        
        $admin->addGroup($adminGroup); 

        if( App::environment('local') )
        {
            $teacherGroup = Sentry::findGroupByName('Teacher');

            $trait = $this->teacherTraitRepository->create(['grade'=>'K']);

            $garcia = $this->teacherRepository->create([
                                        'first_name'=>'Roberto',
                                        'last_name'=>'Garcia',
                                        'title'=>'Ms',
                                        'email'=>'rgarcia@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>1,
                                        'traits_id'=>$trait->id
                                        ]);
            $trait = $this->teacherTraitRepository->create(['grade'=>'K']);

            $gill = $this->teacherRepository->create([
                                        'first_name'=>'Harpreet',
                                        'last_name'=>'Gill',
                                        'title'=>'Mr',
                                        'email'=>'hgill@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>1,
                                        'traits_id'=>$trait->id
                                        ]);

            
            $trait = $this->teacherTraitRepository->create(['grade'=>'K']);

            $smith = $this->teacherRepository->create([
                                        'first_name'=>'Jim',
                                        'last_name'=>'Smith',
                                        'title'=>'Ms',
                                        'email'=>'jsmith@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>1,
                                        'traits_id'=>$trait->id
                                    ]);
            
            $trait = $this->teacherTraitRepository->create(['grade'=>'K']);

            $smith = $this->teacherRepository->create([
                                        'first_name'=>'Jordan',
                                        'last_name'=>'Williams',
                                        'title'=>'Ms',
                                        'email'=>'jwilliams@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>1,
                                        'traits_id'=>$trait->id
                                    ]);

            $parentGroup = Sentry::findGroupByName('Parent');

            $alan = $this->parentRepository->create([
                                        'first_name'=>'Alan',
                                        'last_name'=>'Ruvalcaba',
                                        'title'=>'Mr',
                                        'email'=>'aruval3@gmail.com',
                                        'password'=>'letmein1',
                                        'activated'=>'1',
                                    ]);
            $neeru = $this->parentRepository->create([
                                        'first_name'=>'Neeru',
                                        'last_name'=>'Bansal',
                                        'title'=>'Ms',
                                        'email'=>'nbansal@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>'1',
                                        ]);
			$demo = $this->parentRepository->create([
                                        'first_name'=>'Demo',
                                        'last_name'=>'Demo',
                                        'title'=>'Ms',
                                        'email'=>'demo@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>'1',
                                    ]);

            $child = $this->studentRepository->create([
                                        'first_name'=>'Child',
                                        'last_name'=>'Demo',
                                        'title'=>'Ms',
                                        'email'=>'studentdemo@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>'0',
                                    ]);
            $demo->students()->attach($child->id);

            

        }    
	}

}
