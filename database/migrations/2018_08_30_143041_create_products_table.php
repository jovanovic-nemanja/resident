<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('MOQ')->defaultValue(1);
            $table->text('description');
            $table->integer('user_id');
            $table->string('username');
            $table->float('price_from');
            $table->float('price_to');
            $table->integer('status')->nullable();
            $table->integer('category_id');
            $table->string('image_url')->nullable();
            $table->string('slug')->unique();
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
        Schema::dropIfExists('products');
    }
}
