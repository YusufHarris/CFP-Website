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
			$table->dateTime('createTS')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('createUser')->nullable();
			$table->date('dateSet')->nullable()->useCurrent();
			$table->text('hiveNumber')->nullable();
			$table->text('hiveSource')->nullable();
			$table->text('hiveType')->nullable();
			$table->uuid('id');
			$table->string('id_OP_08BeekeepingCooperatives', 36)->nullable();
			$table->dateTime('modTS')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

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
		Schema::connection('mysql2')->drop('OP_08Beehives');
	}

}
