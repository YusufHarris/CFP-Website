<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOP03ReservoirsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('OP_03Reservoirs', function(Blueprint $table)
		{
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->text('failed')->nullable();
			$table->date('failedDate')->nullable()->default('0000-00-00');
			$table->string('id', 36)->unique('id');
			$table->string('id_OP_03RainwaterHarvestingSystems', 36)->nullable();
			$table->text('identification')->nullable();
			$table->date('installationDate')->nullable()->default('0000-00-00');
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->smallInteger('reservoirCapacity')->nullable();
			$table->text('reservoirType')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('OP_03Reservoirs');
	}

}
