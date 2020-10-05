<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id');
            
            $table->string('product_name');
            $table->integer('alternative_product')->nullable();

            $table->integer('available');

            $table->integer('sender');

            $table->integer('unit');
            $table->integer('volume');
            $table->decimal('product_price')->nullable();
            $table->decimal('alternative_product_price')->nullable();

            $table->decimal('shipping_price')->nullable();
            $table->integer('shipping_weight')->nullable();
            $table->integer('shipping_unit')->nullable();
            $table->string('shipping_desc')->nullable();

            $table->decimal('other_price')->nullable();
            $table->string('other_price_desc')->nullable();

            $table->decimal('total_price');

            $table->datetime('sign_date');
            $table->integer('status')->nullable();
            
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
        Schema::dropIfExists('quotes');
    }
}
