<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSVEconomicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('SV_Economic', function(Blueprint $table)
		{
			$table->smallInteger('adults')->nullable();
			$table->smallInteger('chickens')->nullable();
			$table->smallInteger('children')->nullable();
			$table->text('comments')->nullable();
			$table->smallInteger('cows')->nullable();
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->smallInteger('donkeys')->nullable();
			$table->text('drinkingWaterSource')->nullable();
			$table->text('drinkingWaterSourceOther')->nullable();
			$table->smallInteger('ducks')->nullable();
			$table->smallInteger('elders')->nullable();
			$table->text('flooringType')->nullable();
			$table->text('flooringTypeOther')->nullable();
			$table->smallInteger('goats')->nullable();
			$table->text('headHousehold')->nullable();
			$table->uuid('id');
			$table->string('id_SV_Surveys', 36)->nullable();
			$table->text('itemsOwned')->nullable();
			$table->text('itemsOwnedOther')->nullable();
			$table->text('livelihoods')->nullable();
			$table->text('livelihoodsOther')->nullable();
			$table->text('livestock')->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->text('roofingType')->nullable();
			$table->text('roofingTypeOther')->nullable();
			$table->smallInteger('sheep')->nullable();
			$table->text('toiletType')->nullable();
			$table->text('toiletTypeOther')->nullable();
			$table->smallInteger('totRooms')->nullable();
			$table->text('wallType')->nullable();
			$table->text('wallTypeOther')->nullable();

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
		Schema::connection('mysql2')->drop('SV_Economic');
	}

}
