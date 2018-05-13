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
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_BN_Communities', 36)->nullable();
			$table->string('id_LK_KeyActivities', 36)->nullable();
			$table->text('mF')->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->date('monthRegistered')->nullable()->default('0000-00-00');
			$table->smallInteger('totalBeneficiaries')->nullable();
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
