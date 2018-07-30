<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryTypesTable extends Migration
{
    public function up()
    {
        echo "Create DeliveryTypes Table\r\n";

        Schema::create(config('tables.DeliveryTypes'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->boolean('enabled')->default(1);
            $table->integer('position')->unsigned()->default(0);
        });
    }
}
