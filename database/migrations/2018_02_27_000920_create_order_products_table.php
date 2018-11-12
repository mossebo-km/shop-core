<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    public function up()
    {
        echo "Create OrderProducts Table\r\n";

        Schema::create(config('tables.OrderProducts'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id')->index();

            $table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')->on(config('tables.Orders'))->onDelete('cascade');

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'));

            $table->integer('default_price')->unsigned();
            $table->integer('final_price')->unsigned();

            $table->integer('base_price_type_id')->unsigned()->index();
            $table->foreign('base_price_type_id')->references('id')->on(config('tables.PriceTypes'));

            $table->integer('final_price_type_id')->unsigned()->index();
            $table->foreign('final_price_type_id')->references('id')->on(config('tables.PriceTypes'));

            $table->char('currency_code', 3);
            $table->foreign('currency_code')->references('code')->on(config('tables.Currencies'));

            $table->integer('quantity')->unsigned();

            $table->text('params');

            $table->timestamps();
        });
    }
}
