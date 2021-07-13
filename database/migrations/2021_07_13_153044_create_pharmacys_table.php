<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmacysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacys', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('pharmacy_firstname');
            $table->string('pharmacy_lastname');
            $table->string('pharmacy_street1');
            $table->string('pharmacy_street2')->nullable();
            $table->string('pharmacy_city');
            $table->string('pharmacy_phone')->nullable();
            $table->string('pharmacy_fax')->nullable();
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
        Schema::dropIfExists('pharmacys');
    }
}
