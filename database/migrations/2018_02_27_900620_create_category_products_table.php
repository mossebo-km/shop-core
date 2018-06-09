<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductsTable extends Migration
{
    public function up()
    {
        echo "Create CategoryProducts Table\r\n";

        Schema::create(config('tables.CategoryProducts'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on(config('tables.Categories'))->onDelete('cascade');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');

            $table->primary(['category_id', 'product_id']);
        });
    }
}
