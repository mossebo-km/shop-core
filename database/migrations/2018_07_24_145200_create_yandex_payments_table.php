<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYandexPaymentsTable extends Migration
{
    public function up()
    {
        echo "Create YandexPayments Table\r\n";

        Schema::create(config('tables.YandexPayments'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id');

            $table->string('yandex_payment_id');
            $table->integer('amount')->unsigned();
            $table->string('currency_code');
            $table->string('status');

            $table->timestamps();
        });
    }
}