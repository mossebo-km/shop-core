<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimilarProductsTable extends Migration
{
    public function up()
    {
        Schema::create(config('tables.SimilarProducts'), function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');

            $table->integer('similar_id')->unsigned();
            $table->foreign('similar_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');
        });
    }
}
