<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeOptionsI18nTable extends Migration
{
    public function up()
    {
        echo "Create AttributeOptionsI18n Table\r\n";

        Schema::create(config('tables.AttributeOptionsI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('option_id')->unsigned();
            $table->foreign('option_id')->references('id')->on(config('tables.AttributeOptions'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('value');

            $table->primary(['option_id', 'language_code'])->index();
        });
    }
}
