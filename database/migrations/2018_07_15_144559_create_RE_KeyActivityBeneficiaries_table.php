<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateREKeyActivityBeneficiariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('RE_KeyActivityBeneficiaries', function(Blueprint $table)
		{
			$table->text('beneficiaryType')->nullable();
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->uuid('id');
			$table->string('id_BN_Communities', 36)->nullable();
			$table->string('id_LK_KeyActivities', 36)->nullable();
			$table->text('mF')->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->date('monthRegistered')->nullable()->useCurrent();
			$table->text('sector')->nullable();
			$table->smallInteger('totalBeneficiaries')->nullable();

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
		Schema::connection('mysql2')->drop('RE_KeyActivityBeneficiaries');
	}

}
