<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOP12ComponentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('OP_12Components', function(Blueprint $table)
		{
			$table->text('category')->nullable();
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->smallInteger('cropCount')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_LK_AgroEcoComponents', 36)->nullable();
			$table->string('id_OP_12SpiceForests', 36)->nullable();
			$table->text('inputTypes')->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('seedSource')->nullable();
			$table->smallInteger('yearPlanted')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('OP_12Components');
	}

}
