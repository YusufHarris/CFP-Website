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
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->text('dateKeyActivity')->nullable();
			$table->text('details')->nullable();
			$table->smallInteger('enterpriseDev')->nullable();
			$table->uuid('id');
			$table->string('id_BN_Communities', 36)->nullable();
			$table->string('id_LK_KeyActivities', 36)->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->date('visitDate')->nullable()->useCurrent();

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
		Schema::connection('mysql2')->drop('OP_00FieldVisits');
	}

}
