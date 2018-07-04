<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStyleProductsTable extends Migration
{
    public function up()
    {
        echo "Create StyleProducts Table\r\n";

        Schema::create(config('tables.StyleProducts'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('style_id')->unsigned();
            $table->foreign('style_id')->references('id')->on(config('tables.Styles'))->onDelete('cascade');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');

            $table->primary(['style_id', 'product_id']);
        });
    }
}
