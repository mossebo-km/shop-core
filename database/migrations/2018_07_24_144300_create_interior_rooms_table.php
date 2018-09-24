<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteriorRoomsTable extends Migration
{
    public function up()
    {
        echo "Create InteriorRooms Table\r\n";

        Schema::create(config('tables.InteriorRooms'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('interior_id')->unsigned();
            $table->foreign('interior_id')->references('id')->on(config('tables.Interiors'))->onDelete('cascade');

            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on(config('tables.Rooms'))->onDelete('cascade');

            $table->primary(['interior_id', 'room_id']);
        });
    }
}
