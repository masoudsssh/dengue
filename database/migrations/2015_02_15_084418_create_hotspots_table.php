<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotspotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hotspots', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('state', 45);
			$table->string('week', 5);
			$table->string('road_name', 45)->nullable();
			$table->string('no_of_cases', 45)->nullable(); 
			$table->datetime('start')->nullable();
			$table->datetime('end')->nullable();
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
		Schema::drop('hotspots');
	}

}
