<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSVSpiceProductionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('SV_SpiceProduction', function(Blueprint $table)
		{
			$table->text('buyers')->nullable();
			$table->text('certifications')->nullable();
			$table->text('certificationsInterest')->nullable();
			$table->text('comments')->nullable();
			$table->smallInteger('costToMarket')->nullable();
			$table->smallInteger('costToMarketTransactions')->nullable();
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->text('extWorkersType')->nullable();
			$table->smallInteger('foodConsumption')->nullable();
			$table->uuid('id');
			$table->string('id_SV_Surveys', 36)->nullable();
			$table->smallInteger('ipm')->nullable();
			$table->text('landUseHistory')->nullable();
			$table->text('livelihoods')->nullable();
			$table->text('marketPenetration')->nullable();
			$table->text('microfinancing')->nullable();
			$table->text('microfinancingForm')->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->smallInteger('numFamily')->nullable();
			$table->text('packaging')->nullable();
			$table->smallInteger('phClearingUnderstory')->nullable();
			$table->smallInteger('phHarvesting')->nullable();
			$table->smallInteger('phIrrigation')->nullable();
			$table->smallInteger('phPruning')->nullable();
			$table->text('processingStandards')->nullable();
			$table->text('productionTotalsPerYear')->nullable();
			$table->text('projectedTotals')->nullable();
			$table->text('soilType')->nullable();
			$table->text('supportTypesReceived')->nullable();
			$table->text('tenureRelationship')->nullable();
			$table->smallInteger('totMgmtCosts')->nullable();
			$table->text('valueAdditions')->nullable();
			$table->text('whoDecidesPrice')->nullable();

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
		Schema::connection('mysql2')->drop('SV_SpiceProduction');
	}

}
