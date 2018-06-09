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
            $table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')->on(config('tables.Orders'))->onDelete('cascade');

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'));

            $table->text('product_params');

            $table->string('title');
            $table->text('description');
            $table->integer('price')->unsigned()->index();
            $table->char('currency_code', 3);
            $table->foreign('currency_code')->references('code')->on(config('tables.Currencies'));
            $table->integer('quantity')->unsigned();
            $table->string('image_path')->nullable();

            $table->primary(['order_id', 'product_id']);
        });
    }
}
