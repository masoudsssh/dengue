<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotspotMastersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hotspot_masters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('state', 45);
			$table->string('district', 45)->nullable();
			$table->string('area', 45)->nullable();
			$table->string('group_address', 45)->nullable();
			$table->string('road_name', 45)->nullable();
			$table->string('gps_location', 45)->nullable();
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
		Schema::drop('hotspot_masters');
	}

}
