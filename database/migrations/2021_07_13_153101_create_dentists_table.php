<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDentistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dentists', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('dentist_firstname');
            $table->string('dentist_lastname');
            $table->string('dentist_street1');
            $table->string('dentist_street2')->nullable();
            $table->string('dentist_city');
            $table->string('dentist_phone')->nullable();
            $table->string('dentist_fax')->nullable();
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
        Schema::dropIfExists('dentists');
    }
}
