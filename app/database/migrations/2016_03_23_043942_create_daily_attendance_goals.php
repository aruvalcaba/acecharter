<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyAttendanceGoals extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('daily_attendance_goals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('student_id')->unsigned();
			$table->integer('school_id');
			$table->integer('attendance');
			$table->integer('tardy');		
			$table->integer('infraction');		
			$table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('school_id')->references('school_id')->on('schools')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('daily_attendance_goals');
	}

}
