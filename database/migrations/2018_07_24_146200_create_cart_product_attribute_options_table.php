<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartProductAttributeOptionsTable extends Migration
{
    public function up()
    {
        echo "Create CartProductAttributeOptions Table\r\n";

        Schema::create(config('tables.CartProductAttributeOptions'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('cart_product_id')->unsigned()->index();
            $table->foreign('cart_product_id')->references('id')->on(config('tables.CartProducts'))->onDelete('cascade');

            $table->integer('option_id')->unsigned();
            $table->foreign('option_id')->references('id')->on(config('tables.AttributeOptions'))->onDelete('cascade');

            $table->primary(['cart_product_id', 'option_id']);
        });
    }
}