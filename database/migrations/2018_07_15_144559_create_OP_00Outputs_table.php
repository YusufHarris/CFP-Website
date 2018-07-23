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
			$table->smallInteger('altitude')->nullable();
			$table->smallInteger('areaMetersSquared')->nullable();
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->date('dateEstablished')->nullable()->useCurrent();
			$table->text('gpsTrackFilter')->nullable();
			$table->smallInteger('hAccuracy')->nullable();
			$table->uuid('id');
			$table->string('id_BN_Communities', 36)->nullable();
			$table->string('id_LK_KeyActivities', 36)->nullable();
			$table->smallInteger('latitude')->nullable();
			$table->smallInteger('longitude')->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->text('uniqueMIName')->nullable();
			$table->smallInteger('vAccuracy')->nullable();
			$table->smallInteger('yearFilter')->nullable();

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
		Schema::connection('mysql2')->drop('OP_00Outputs');
	}

}
