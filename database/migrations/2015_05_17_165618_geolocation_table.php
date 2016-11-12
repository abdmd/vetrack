<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GeolocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geolocation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('vehicleId');
			$table->float('lng');
			$table->float('lat');
			$table->string('status')->default('offline');
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
		Schema::drop('geolocation');
	}

}
