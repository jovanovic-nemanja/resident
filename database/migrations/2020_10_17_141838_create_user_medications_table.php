<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_medications', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('medications')->unsigned();
            $table->foreign('medications')->references('id')->on('medications');
            
            $table->integer('daily_count');
            $table->integer('duration');
            
            $table->integer('resident')->unsigned();
            $table->foreign('resident')->references('id')->on('users');

            $table->string('comment', '2048')->nullable();
            $table->string('file', '2048')->nullable();

            $table->integer('status')->nullable();
            $table->datetime('sign_date');

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
        Schema::dropIfExists('user_medications');
    }
}
