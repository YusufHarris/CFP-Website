<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('admin')->default(0);
            $table->boolean('enabled')->default(1);
            $table->boolean('manager')->default(0);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

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
        Schema::dropIfExists('users');
    }
}
