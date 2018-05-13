<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOP00OutputsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('OP_00Outputs', function(Blueprint $table)
		{
			$table->smallInteger('accuracy')->nullable();
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->date('dateEstablished')->nullable()->default('0000-00-00');
			$table->text('gpsTrackFilter')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_BN_Communities', 36)->nullable();
			$table->string('id_LK_KeyActivities', 36)->nullable();
			$table->smallInteger('latitude')->nullable();
			$table->smallInteger('longitude')->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('uniqueMIName')->nullable();
			$table->smallInteger('yearFilter')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('OP_00Outputs');
	}

}
