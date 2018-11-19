<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartPromoTable extends Migration
{
    public function up()
    {
        echo "Create CartPromo Table\r\n";

        Schema::create(config('tables.CartPromo'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('cart_id')->unsigned()->index();
            $table->foreign('cart_id')->references('id')->on(config('tables.Carts'))->onDelete('cascade');

            $table->integer('promo_code_id')->unsigned();
            $table->foreign('promo_code_id')->references('id')->on(config('tables.PromoCodes'))->onDelete('cascade');

            $table->primary(['cart_id', 'promo_code_id']);

            $table->timestamps();
        });
    }
}