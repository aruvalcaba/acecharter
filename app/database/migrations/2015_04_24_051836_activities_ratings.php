<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActivitiesRatings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities_ratings', function(Blueprint $table)
        {
            $table->integer('activity_id')->unsigned();
            $table->integer('total');
            $table->integer('count');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activities_ratings');
	}

}
