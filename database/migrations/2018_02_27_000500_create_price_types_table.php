<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTypesTable extends Migration
{
    public function up()
    {
        echo "Create PriceTypes Table\r\n";

        Schema::create(config('tables.PriceTypes'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->boolean('default')->default(0);
            $table->boolean('enabled')->default(0);
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
        });
    }
}
