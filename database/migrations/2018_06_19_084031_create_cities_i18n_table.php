<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesI18nTable extends Migration
{
    public function up()
    {
        echo "Create CitiesI18n Table\r\n";

        Schema::create(config('tables.CitiesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on(config('tables.Cities'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('name');

            $table->primary(['city_id', 'language_code'])->index();
        });
    }
}
