<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBNCommunitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('BN_Communities', function(Blueprint $table)
		{
			$table->text('community')->nullable();
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->smallInteger('fBeneficiaries')->nullable();
			$table->smallInteger('fIndirectTrainees')->nullable();
			$table->smallInteger('fTrainees')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_BN_Districts', 36)->nullable();
			$table->smallInteger('latitude')->nullable();
			$table->smallInteger('longitude')->nullable();
			$table->smallInteger('mBeneficiaries')->nullable();
			$table->smallInteger('mIndirectTrainees')->nullable();
			$table->smallInteger('mTrainees')->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->smallInteger('sroia')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('BN_Communities');
	}

}
