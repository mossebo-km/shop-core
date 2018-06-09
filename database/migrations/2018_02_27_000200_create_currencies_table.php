<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    public function up()
    {
        echo "Create Currencies Table\r\n";

        Schema::create(config('tables.Currencies'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->char('code', 3)->primary()->index();
            $table->string('name');
            $table->string('symbol');
            $table->tinyInteger('precision');
            $table->string('thousand_separator', 64);
            $table->string('decimal_separator', 64);
            $table->boolean('swap_currency_symbol')->default(false);
            $table->boolean('enabled')->default(0);
            $table->integer('position')->unsigned()->default(0);

            $table->timestamps();
        });
    }
}
