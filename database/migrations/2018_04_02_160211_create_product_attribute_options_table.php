<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeOptionsTable extends Migration
{
    public function up()
    {
        echo "Create ProductAttributeOptions Table\r\n";

        Schema::create(config('tables.ProductAttributeOptions'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');

            $table->integer('attribute_id')->unsigned()->index();
            $table->foreign('attribute_id')->references('id')->on(config('tables.Attributes'))->onDelete('cascade');

            $table->integer('option_id')->unsigned()->index();
            $table->foreign('option_id')->references('id')->on(config('tables.AttributeOptions'))->onDelete('cascade');

            $table->unique(['product_id', 'option_id']);
            $table->index(['product_id', 'option_id']);
            $table->index(['product_id', 'attribute_id', 'option_id'], 'product_attr_option_index');
        });
    }
}
