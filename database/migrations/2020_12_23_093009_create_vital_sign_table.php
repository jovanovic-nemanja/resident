<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitalSignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vital_sign', function (Blueprint $table) {
            $table->increments('id');

            $table->string('blood_pressure');
            $table->string('temperature');
            $table->string('heart_rate');
            $table->integer('resident_id')->unsigned();
            $table->foreign('resident_id')->references('id')->on('users');
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
        Schema::dropIfExists('vital_sign');
    }
}
