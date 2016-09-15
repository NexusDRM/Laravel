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
            $table->string('title')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('suffix')->nullable();
            $table->string('streetAddress')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('newsletterOptIn')->nullable();
            $table->string('avatar')->nullable();
            $table->string('nickname')->nullable();
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
