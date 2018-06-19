<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesI18nTable extends Migration
{
    public function up()
    {
        echo "Create CountriesI18n Table\r\n";

        Schema::create(config('tables.CountriesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->char('country_code', 2);
            $table->foreign('country_code')->references('code')->on(config('tables.Countries'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('name');

            $table->primary(['country_code', 'language_code'])->index();
        });
    }
}
