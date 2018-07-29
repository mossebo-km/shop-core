<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusesTable extends Migration
{
    public function up()
    {
        echo "Create OrderStatuses Table\r\n";

        Schema::create(config('tables.OrderStatuses'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();
            $table->string('color', 64)->nullable();
            $table->integer('position')->unsigned()->default(0);
        });
    }
}
