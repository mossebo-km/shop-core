<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCountTable extends Migration
{
    public function up()
    {
        echo "Create ProductCount Table\r\n";

        Schema::create(config('tables.ProductCounts'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on(config('tables.Categories'))->onDelete('cascade');

            $table->integer('room_id')->unsigned()->nullable();
            $table->foreign('room_id')->references('id')->on(config('tables.Rooms'))->onDelete('cascade');

            $table->integer('style_id')->unsigned()->nullable();
            $table->foreign('style_id')->references('id')->on(config('tables.Styles'))->onDelete('cascade');

            $table->integer('count')->unsigned()->nullable()->default(0);

            $table->timestamps();
        });
    }
}