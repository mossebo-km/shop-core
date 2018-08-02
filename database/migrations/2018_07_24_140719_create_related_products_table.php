<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedProductsTable extends Migration
{
    public function up()
    {
        echo "Create RelatedProducts Table\r\n";

        Schema::create(config('tables.RelatedProducts'), function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');

            $table->integer('related_id')->unsigned();
            $table->foreign('related_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');

            $table->primary(['product_id', 'related_id']);
        });
    }
}
