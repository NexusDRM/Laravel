<?php

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
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('title');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('suffix');
            $table->string('streetAddress');
            $table->string('city');
            $table->string('state');
            $table->string('postalcode');
            $table->string('phone');
            $table->timestamps();
            $table->boolean('is_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
