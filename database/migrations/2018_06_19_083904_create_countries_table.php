<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        echo "Create Countries Table\r\n";

        Schema::create(config('tables.Countries'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->char('code', 2)->primary()->index();
            $table->integer('position')->unsigned()->default(0);

            $table->char('language_code', 2)->nullable();
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'))->onDelete('set null');

            $table->char('currency_code', 3)->nullable();
            $table->foreign('currency_code')->references('code')->on(config('tables.Currencies'))->onDelete('set null');

            $table->timestamps();
        });
    }
}
