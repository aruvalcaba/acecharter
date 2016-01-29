<?php

use TT\Support\GoalHelper;

class GoalSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
        $this->command->info('Importing goals...');

        $goals = ['Positive Behavior','Daily Attendance','Daily Homework'];

        foreach($goals as $goal) 
        {
            
            DB::table('goals')->insert(['name'=>GoalHelper::format($goal)]);
        }
	}

}
