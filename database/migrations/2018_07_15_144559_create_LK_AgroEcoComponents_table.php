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
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->smallInteger('dbhToBiomassX0')->nullable();
			$table->smallInteger('dbhToBiomassX1')->nullable();
			$table->uuid('id');
			$table->text('latinName')->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->text('name')->nullable();
			$table->smallInteger('spice')->nullable();
			$table->text('swahiliName')->nullable();

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
		Schema::connection('mysql2')->drop('LK_AgroEcoComponents');
	}

}
