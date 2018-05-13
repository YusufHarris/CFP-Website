<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOP09EquipmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('OP_09Equipment', function(Blueprint $table)
		{
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->date('dateInstalled')->nullable()->default('0000-00-00');
			$table->text('details')->nullable();
			$table->text('failed')->nullable();
			$table->date('failedDate')->nullable()->default('0000-00-00');
			$table->string('id', 36)->unique('id');
			$table->string('id_OP_06EnergySystems', 36)->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('serialNumber')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('OP_09Equipment');
	}

}
