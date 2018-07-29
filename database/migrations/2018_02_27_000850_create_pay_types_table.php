<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayTypesTable extends Migration
{
    public function up()
    {
        echo "Create PayTypesTable Table\r\n";

        Schema::create(config('tables.PayTypes'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('position')->unsigned()->default(0);
        });
    }
}
