<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicGoalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('academic_goals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('student_id')->unsigned();
			$table->string('course');
			$table->string('teacher_name');
			$table->string('percentage');
			$table->string('grade');
			$table->date('last_update');
			$table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::drop('academic_goals');
	}

}
