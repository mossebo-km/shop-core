<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesI18nTable extends Migration
{
    public function up()
    {
        echo "Create AttributesI18n Table\r\n";

        Schema::create(config('tables.AttributesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('attribute_id')->unsigned();
            $table->foreign('attribute_id')->references('id')->on(config('tables.Attributes'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('title');

            $table->primary(['attribute_id', 'language_code'])->index();
        });
    }
}
