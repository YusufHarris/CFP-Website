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
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->text('fencingMaterials')->nullable();
			$table->text('framingMaterials')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_OP_02ATreeNurseries', 36)->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->smallInteger('percentCapacity')->nullable();
			$table->smallInteger('yearActive')->nullable();
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
