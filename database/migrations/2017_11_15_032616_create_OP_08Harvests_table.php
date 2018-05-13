<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOP08HarvestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('OP_08Harvests', function(Blueprint $table)
		{
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->date('dateInspection')->nullable()->default('0000-00-00');
			$table->smallInteger('honeyYield')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_OP_08Beehives', 36)->nullable();
			$table->string('id_OP_08BeekeepingCooperatives', 36)->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->smallInteger('waxYield')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('OP_08Harvests');
	}

}
