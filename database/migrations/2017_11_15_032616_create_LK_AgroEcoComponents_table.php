<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLKAgroEcoComponentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('LK_AgroEcoComponents', function(Blueprint $table)
		{
			$table->text('category')->nullable();
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->smallInteger('dbhToBiomassX0')->nullable();
			$table->smallInteger('dbhToBiomassX1')->nullable();
			$table->string('id', 36)->unique('id');
			$table->text('latinName')->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('name')->nullable();
			$table->smallInteger('spice')->nullable();
			$table->text('swahiliName')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('LK_AgroEcoComponents');
	}

}
