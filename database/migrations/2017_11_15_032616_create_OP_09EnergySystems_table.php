<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOP09EnergySystemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('OP_09EnergySystems', function(Blueprint $table)
		{
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_OP_00Outputs', 36)->nullable();
			$table->smallInteger('maxStorageCapacity')->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->smallInteger('totalWattage')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('OP_09EnergySystems');
	}

}
