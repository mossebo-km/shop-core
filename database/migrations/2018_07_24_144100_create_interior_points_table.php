<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteriorPointsTable extends Migration
{
    public function up()
    {
        echo "Create InteriorPoints Table\r\n";

        Schema::create(config('tables.InteriorPoints'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->integer('interior_id')->unsigned();
            $table->foreign('interior_id')->references('id')->on(config('tables.Interiors'))->onDelete('cascade');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');

            $table->string('position_x');
            $table->string('position_y');
            $table->boolean('is_similar');

            $table->timestamps();
        });
    }
}
