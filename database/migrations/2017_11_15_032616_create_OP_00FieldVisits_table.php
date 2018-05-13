<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOP00FieldVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('OP_00FieldVisits', function(Blueprint $table)
		{
			$table->smallInteger('alert')->nullable();
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->text('dateKeyActivity')->nullable();
			$table->text('details')->nullable();
			$table->smallInteger('enterpriseDev')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_BN_Communities', 36)->nullable();
			$table->string('id_LK_KeyActivities', 36)->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->date('visitDate')->nullable()->default('0000-00-00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('OP_00FieldVisits');
	}

}
