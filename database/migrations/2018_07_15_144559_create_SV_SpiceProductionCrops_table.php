<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSVSpiceProductionCropsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('SV_SpiceProductionCrops', function(Blueprint $table)
		{
			$table->smallInteger('avgYield')->nullable();
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->uuid('id');
			$table->string('id_LK_AgroEcoComponents', 36)->nullable();
			$table->string('id_SV_SpiceProduction', 36)->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->smallInteger('plantCount')->nullable();
			$table->smallInteger('pricePerUnit')->nullable();
			$table->text('unitAvgYield')->nullable();
			$table->smallInteger('yearPlanted')->nullable();

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
		Schema::connection('mysql2')->drop('SV_SpiceProductionCrops');
	}

}
