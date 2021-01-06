<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_information', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date_admitted')->nullable();
            $table->text('ssn')->nullable();
            $table->text('primary_language')->nullable();
            $table->text('representing_party_name')->nullable();
            $table->text('representing_party_address')->nullable();
            $table->text('representing_party_home_phone')->nullable();
            $table->text('representing_party_cell_phone')->nullable();
            $table->text('secondary_representative_name')->nullable();
            $table->text('secondary_representative_address')->nullable();
            $table->text('secondary_representative_home_phone')->nullable();
            $table->text('secondary_representative_cell_phone')->nullable();
            $table->text('physician_or_medical_group_name')->nullable();
            $table->text('physician_or_medical_group_address')->nullable();
            $table->text('physician_or_medical_group_phone')->nullable();
            $table->text('physician_or_medical_group_fax')->nullable();
            $table->text('pharmacy_name')->nullable();
            $table->text('pharmacy_address')->nullable();
            $table->text('pharmacy_home_phone')->nullable();
            $table->text('pharmacy_fax')->nullable();
            $table->text('dentist_name')->nullable();
            $table->text('dentist_address')->nullable();
            $table->text('dentist_home_phone')->nullable();
            $table->text('dentist_fax')->nullable();
            $table->text('advance_directive')->nullable();
            $table->text('polst')->nullable();
            $table->text('alergies')->nullable();
            
            $table->datetime('signDate');

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
        Schema::dropIfExists('resident_information');
    }
}
