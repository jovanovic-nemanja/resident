<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->integer('volume');
            // $table->string('payment_method');
            $table->integer('unit')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('port_of_destination', '1024');
            $table->string('additional_information', '2048');
            $table->integer('sender');
            $table->string('receiver')->nullable();
            $table->integer('status')->nullable();
            $table->datetime('sign_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
