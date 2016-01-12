<?php

use TT\Models\Teacher;
use TT\Models\TeacherTrait;
use TT\Models\StudentParent;

use TT\Parent\ParentRepository;

use TT\Teacher\TeacherRepository;
use TT\Teacher\TeacherTraitRepository;


class UserSeeder extends Seeder {

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
            $teacherRepo = new TeacherRepository(new Teacher);

            $teacherTraitRepo = new TeacherTraitRepository(new TeacherTrait);

            $trait = $teacherTraitRepo->create(['grade'=>'K']);

            $garcia = $teacherRepo->create([
                                        'first_name'=>'Roberto',
                                        'last_name'=>'Garcia',
                                        'title'=>'Ms',
                                        'email'=>'rgarcia@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>1,
                                        'traits_id'=>$trait->id
                                        ]);
            $trait = $teacherTraitRepo->create(['grade'=>'K']);

            $gill = $teacherRepo->create([
                                        'first_name'=>'Harpreet',
                                        'last_name'=>'Gill',
                                        'title'=>'Mr',
                                        'email'=>'hgill@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>1,
                                        'traits_id'=>$trait->id
                                        ]);

            
            $trait = $teacherTraitRepo->create(['grade'=>'K']);

            $smith = $teacherRepo->create([
                                        'first_name'=>'Jim',
                                        'last_name'=>'Smith',
                                        'title'=>'Ms',
                                        'email'=>'jsmith@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>1,
                                        'traits_id'=>$trait->id
                                    ]);
            
            $trait = $teacherTraitRepo->create(['grade'=>'K']);

            $smith = $teacherRepo->create([
                                        'first_name'=>'Jordan',
                                        'last_name'=>'Williams',
                                        'title'=>'Ms',
                                        'email'=>'jwilliams@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>1,
                                        'traits_id'=>$trait->id
                                    ]);

            $parentGroup = Sentry::findGroupByName('Parent');
            $parentRepo = new ParentRepository(new StudentParent);

            $alan = $parentRepo->create([
                                        'first_name'=>'Alan',
                                        'last_name'=>'Ruvalcaba',
                                        'title'=>'Mr',
                                        'email'=>'aruval3@gmail.com',
                                        'password'=>'letmein1',
                                        'activated'=>'1',
                                    ]);
            $neeru = $parentRepo->create([
                                        'first_name'=>'Neeru',
                                        'last_name'=>'Bansal',
                                        'title'=>'Ms',
                                        'email'=>'nbansal@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>'1',
                                        ]);
			$demo = $parentRepo->create([
                                        'first_name'=>'Demo',
                                        'last_name'=>'Demo',
                                        'title'=>'Ms',
                                        'email'=>'demo@acecharter.org',
                                        'password'=>'letmein1',
                                        'activated'=>'1',
                                        ]);

        }    
	}

}
