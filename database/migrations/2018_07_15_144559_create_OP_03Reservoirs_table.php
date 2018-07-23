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
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->text('failed')->nullable();
			$table->date('failedDate')->nullable()->useCurrent();
			$table->uuid('id');
			$table->string('id_OP_03RainwaterHarvestingSystems', 36)->nullable();
			$table->text('identification')->nullable();
			$table->date('installationDate')->nullable()->useCurrent();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->smallInteger('reservoirCapacity')->nullable();
			$table->text('reservoirType')->nullable();

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
		Schema::connection('mysql2')->drop('OP_03Reservoirs');
	}

}
