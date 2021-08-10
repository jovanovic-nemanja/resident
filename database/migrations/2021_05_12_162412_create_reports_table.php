<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('type');    //primary activity or medication or PRN.... as 1, 2, 3
            $table->text('description');
            $table->integer('clinic_id'); //clinic id.
            $table->integer('resident_id'); //resident id of user table.
            $table->integer('user_id'); // admin or caregiver id of user table.
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
        Schema::dropIfExists('reports');
    }
}
