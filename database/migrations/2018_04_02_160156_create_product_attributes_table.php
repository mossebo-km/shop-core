<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributesTable extends Migration
{
    public function up()
    {
        echo "Create ProductAttributes Table\r\n";

        Schema::create(config('tables.ProductAttributes'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');

            $table->integer('attribute_id')->unsigned()->index();
            $table->foreign('attribute_id')->references('id')->on(config('tables.Attributes'))->onDelete('cascade');

            $table->primary(['product_id', 'attribute_id']);
        });
    }
}
