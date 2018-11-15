<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        echo "Create Payments Table\r\n";

        Schema::create(config('tables.Payments'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on(config('tables.Orders'));

            $table->morphs('details');
        });
    }
}
