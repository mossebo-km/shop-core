<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsbTransactionsTable extends Migration
{
    public function up()
    {
        echo "Create MsbTransactions Table\r\n";

        Schema::create(config('tables.MsbTransactions'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on(config('tables.Users'))->onDelete('cascade');

            $table->integer('amount');
        });
    }
}
