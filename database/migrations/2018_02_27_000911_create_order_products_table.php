<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        echo "Create OrderProducts Table\r\n";

        Schema::create(config('tables.OrderProducts'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('order_id')->nullable()->unsigned()->index();
            $table->foreign('order_id')->references('id')->on(config('tables.Orders'))->onDelete('cascade');

            $table->integer('product_id')->nullable()->unsigned()->index();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'));

            $table->integer('price'); // Цена по умолчанию
            $table->integer('final_price'); // Финальная цена
        });
    }
}
