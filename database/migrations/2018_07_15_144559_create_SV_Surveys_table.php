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
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->uuid('id');
			$table->string('id_BN_ComMember', 36)->nullable();
			$table->string('id_BN_Communities', 36)->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->date('surveyDate')->nullable()->useCurrent();
			$table->text('surveyType')->nullable();

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
		Schema::connection('mysql2')->drop('SV_Surveys');
	}

}
