<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOP08BeehivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('OP_08Beehives', function(Blueprint $table)
		{
			$table->text('beeType')->nullable();
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->date('dateSet')->nullable()->default('0000-00-00');
			$table->text('hiveNumber')->nullable();
			$table->text('hiveSource')->nullable();
			$table->text('hiveType')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_OP_08BeekeepingCooperatives', 36)->nullable();
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
		Schema::connection('mysql2')->drop('OP_08Beehives');
	}

}
