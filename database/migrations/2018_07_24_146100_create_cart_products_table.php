<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartProductsTable extends Migration
{
    public function up()
    {
        echo "Create CartProducts Table\r\n";

        Schema::create(config('tables.CartProducts'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id');

            $table->integer('cart_id')->unsigned()->index();
            $table->foreign('cart_id')->references('id')->on(config('tables.Carts'))->onDelete('cascade');

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');

            $table->integer('quantity');
            $table->text('params');

            $table->timestamps();
        });
    }
}