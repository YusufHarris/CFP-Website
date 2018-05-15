<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSVSurveysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('SV_Surveys', function(Blueprint $table)
		{
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_BN_ComMember', 36)->nullable();
			$table->string('id_BN_Communities', 36)->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->date('surveyDate')->nullable()->default('0000-00-00');
			$table->text('surveyType')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('SV_Surveys');
	}

}
