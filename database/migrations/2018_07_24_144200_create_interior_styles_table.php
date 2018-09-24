<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteriorStylesTable extends Migration
{
    public function up()
    {
        echo "Create InteriorStyles Table\r\n";

        Schema::create(config('tables.InteriorStyles'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('interior_id')->unsigned();
            $table->foreign('interior_id')->references('id')->on(config('tables.Interiors'))->onDelete('cascade');

            $table->integer('style_id')->unsigned();
            $table->foreign('style_id')->references('id')->on(config('tables.Styles'))->onDelete('cascade');

            $table->primary(['interior_id', 'style_id']);
        });
    }
}
