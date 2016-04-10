<?php


class SchoolSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
        $this->command->info('Importing Schools...');

        $schools = ['131656'=>'ACE Inspire','129247'=>'ACE Franklin McKinley','129254'=>'ACE Creative Arts Academy','116814'=>'ACE Empower','125617'=>'ACE High School'];

        foreach($schools as $id=>$school) 
        {
            
            DB::table('schools')->insert(['school_id'=>intval($id),'name'=> $school]);
        }
	}

}
