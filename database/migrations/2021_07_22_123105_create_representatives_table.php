<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representatives', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->integer('representative_type')->defaultValue(1);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('street1');
            $table->string('street2')->nullable();
            $table->string('city');
            $table->string('zip_code');
            $table->string('state');
            $table->string('home_phone')->nullable();
            $table->string('cell_phone')->nullable();
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
        Schema::dropIfExists('representatives');
    }
}
