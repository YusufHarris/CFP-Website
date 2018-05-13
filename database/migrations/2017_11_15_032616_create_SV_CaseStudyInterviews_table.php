<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSVCaseStudyInterviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('SV_CaseStudyInterviews', function(Blueprint $table)
		{
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_BN_ComMembers', 36)->nullable();
			$table->date('interviewDate')->nullable()->default('0000-00-00');
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('transcript')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('SV_CaseStudyInterviews');
	}

}
