<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->integer('poa_type')->defaultValue(1);
            $table->string('poa_firstname');
            $table->string('poa_lastname');
            $table->string('poa_street1');
            $table->string('poa_street2')->nullable();
            $table->string('poa_city');
            $table->string('poa_zip_code');
            $table->string('poa_state');
            $table->string('poa_home_phone')->nullable();
            $table->string('poa_cell_phone')->nullable();
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
        Schema::dropIfExists('poas');
    }
}
