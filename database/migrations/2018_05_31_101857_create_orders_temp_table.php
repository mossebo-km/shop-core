<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTempTable extends Migration
{
    public function up()
    {
        echo "Create OrdersTemp Table\r\n";

        Schema::create(config('tables.OrdersTemp'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();
            $table->longText('data')->nullable();
            $table->timestamps();
        });
    }
}
