<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    public function up()
    {
        echo "Create Carts Table\r\n";

        Schema::create(config('tables.Carts'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on(config('tables.Users'));

            $table->char('currency_code', 3);
            $table->foreign('currency_code')->references('code')->on(config('tables.Currencies'));

            $table->timestamps();
        });
    }
}