<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBNGovAgenciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('BN_GovAgencies', function(Blueprint $table)
		{
			$table->text('agencyAcronym')->nullable();
			$table->text('agencyName')->nullable();
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->string('id', 36)->unique('id');
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('BN_GovAgencies');
	}

}
