<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTypesI18nTable extends Migration
{
    public function up()
    {
        echo "Create PriceTypesI18n Table\r\n";

        Schema::create(config('tables.PriceTypesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('price_type_id')->unsigned();
            $table->foreign('price_type_id')->references('id')->on(config('tables.PriceTypes'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('title')->nullable();
            $table->string('description')->nullable();

            $table->primary(['price_type_id', 'language_code'])->index();
        });
    }
}
