<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSVSpiceProductionGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('SV_SpiceProductionGrades', function(Blueprint $table)
		{
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->smallInteger('grade')->nullable();
			$table->uuid('id');
			$table->string('id_LK_AgroEcoComponents', 36)->nullable();
			$table->string('id_SV_SpiceProduction', 36)->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->text('processingSteps')->nullable();
			$table->text('totalProcessingCosts')->nullable();

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
		Schema::connection('mysql2')->drop('SV_SpiceProductionGrades');
	}

}
