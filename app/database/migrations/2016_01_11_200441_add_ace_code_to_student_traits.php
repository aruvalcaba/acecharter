<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAceCodeToStudentTraits extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students_traits', function(Blueprint $table)
		{
			$table->string('ace_code',5);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('students_traits', function(Blueprint $table)
		{
			$table->dropColumn('ace_code');
		});
	}

}
