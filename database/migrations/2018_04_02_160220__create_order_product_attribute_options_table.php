<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductAttributeOptionsTable extends Migration
{
    public function up()
    {
        echo "Create OrderProductAttributeOptions Table\r\n";

        Schema::create(config('tables.OrderProductAttributeOptions'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('order_product_id')->nullable()->unsigned()->index();
            $table->foreign('order_product_id')->references('id')->on(config('tables.OrderProducts'))->onDelete('cascade');

            $table->integer('option_id')->unsigned();
            $table->foreign('option_id')->references('id')->on(config('tables.AttributeOptions'));
        });
    }
}
