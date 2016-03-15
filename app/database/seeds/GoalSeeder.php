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

        $goals = ['Academic Success','Daily Attendance','Punctuality','Positive Behavior'];

        foreach($goals as $goal) 
        {
            
            DB::table('goals')->insert(['name'=>GoalHelper::format($goal)]);
        }
	}

}
