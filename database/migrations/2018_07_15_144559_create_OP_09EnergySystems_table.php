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
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->uuid('id');
			$table->string('id_OP_00Outputs', 36)->nullable();
			$table->smallInteger('maxStorageCapacity')->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->smallInteger('totalWattage')->nullable();

			$table->primary('id');
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
