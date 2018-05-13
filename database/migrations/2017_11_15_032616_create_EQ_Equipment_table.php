<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEQEquipmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('EQ_Equipment', function(Blueprint $table)
		{
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->smallInteger('distributeCount')->nullable();
			$table->smallInteger('equipCount')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_EQLK_EquipmentTypes', 36)->nullable();
			$table->string('id_LK_KeyActivities', 36)->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->date('purchaseDate')->nullable()->default('0000-00-00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('EQ_Equipment');
	}

}
