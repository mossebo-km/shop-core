<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomProductsTable extends Migration
{
    public function up()
    {
        echo "Create RoomProducts Table\r\n";

        Schema::create(config('tables.RoomProducts'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on(config('tables.Rooms'))->onDelete('cascade');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on(config('tables.Products'))->onDelete('cascade');

            $table->primary(['room_id', 'product_id']);
        });
    }
}
