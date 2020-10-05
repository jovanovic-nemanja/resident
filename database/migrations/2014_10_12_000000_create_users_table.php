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
            $table->increments('id');
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('email')->unique();

            // Cached from GitHub
            $table->string('github_id')->unique()->nullable();

            // Cached from Google
            $table->string('google_id')->nullable();

            $table->integer('gender');
            $table->date('birthday');
            $table->string('address');


            $table->integer('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('block')->defaultValue(0)->nullable();
            $table->string('phone_number')->nullable();
            $table->datetime('sign_date');
            $table->rememberToken();
            $table->timestamps();
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
