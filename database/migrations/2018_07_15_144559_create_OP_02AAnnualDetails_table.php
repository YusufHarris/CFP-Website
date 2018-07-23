<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOP02AAnnualDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('OP_02AAnnualDetails', function(Blueprint $table)
		{
			$table->smallInteger('areaMetersSquared')->nullable();
			$table->text('coveringMaterials')->nullable();
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->text('fencingMaterials')->nullable();
			$table->text('framingMaterials')->nullable();
			$table->uuid('id');
			$table->string('id_OP_02ATreeNurseries', 36)->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->smallInteger('percentCapacity')->nullable();
			$table->smallInteger('yearActive')->nullable();

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
		Schema::connection('mysql2')->drop('OP_02AAnnualDetails');
	}

}
