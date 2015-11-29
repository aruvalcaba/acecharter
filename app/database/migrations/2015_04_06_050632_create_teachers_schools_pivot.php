<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersSchoolsPivot extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teachers_schools', function(Blueprint $table)
        {
            $table->integer('teacher_id')->unsigned();
            $table->integer('school_id')->unsigned();

            $table->engine = 'InnoDB';
            $table->primary(['teacher_id','school_id']);
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('teachers_schools');
	}

}
