<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOP01ComponentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('OP_01Components', function(Blueprint $table)
		{
			$table->text('category')->nullable();
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_LK_AgroEcoComponents', 36)->nullable();
			$table->string('id_OP_01AgroforestrySystems', 36)->nullable();
			$table->text('inputTypes')->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->smallInteger('perennialCount')->nullable();
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
		Schema::connection('mysql2')->drop('OP_01Components');
	}

}
