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
			$table->string('city', 45);
			$table->datetime('time')->nullable();
			$table->string('locality', 45)->nullable();
			$table->string('gps', 45)->nullable();
			$table->integer('death')->nullable();
			$table->integer('case')->nullable();
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
