<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusesI18nTable extends Migration
{
    public function up()
    {
        echo "Create OrderStatusesI18n Table\r\n";

        Schema::create(config('tables.OrderStatusesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('order_status_id')->unsigned();
            $table->foreign('order_status_id')->references('id')->on(config('tables.OrderStatuses'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('name', 64);

            $table->primary(['order_status_id', 'language_code'])->index();
        });
    }
}
