<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        echo "Create PayTypesTable Table\r\n";

        Schema::create(config('tables.PayTypesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('pay_type_id')->unsigned()->index();
            $table->foreign('pay_type_id')->references('id')->on(config('tables.PayTypes'))->onDelete('cascade');

            $table->string('name');
        });
    }
}
