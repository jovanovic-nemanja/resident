<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhysicianMedicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physician_medicals', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('physician_or_medical_group_firstname');
            $table->string('physician_or_medical_group_lastname');
            $table->string('physician_or_medical_group_street1');
            $table->string('physician_or_medical_group_street2')->nullable();
            $table->string('physician_or_medical_group_city');
            $table->string('physician_or_medical_group_phone')->nullable();
            $table->string('physician_or_medical_group_fax')->nullable();
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
        Schema::dropIfExists('physician_medicals');
    }
}
