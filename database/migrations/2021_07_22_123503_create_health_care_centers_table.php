<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthCareCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_care_centers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->integer('health_care_center_type')->defaultValue(1);
            $table->string('firstname');
            $table->string('email');
            $table->text('zip_code');   
            $table->string('street1');
            $table->string('street2')->nullable();
            $table->string('city');
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
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
        Schema::dropIfExists('health_care_centers');
    }
}
