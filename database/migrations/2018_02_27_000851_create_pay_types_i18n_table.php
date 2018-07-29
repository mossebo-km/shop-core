<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayTypesI18nTable extends Migration
{
    public function up()
    {
        echo "Create PayTypesI18nTable Table\r\n";

        Schema::create(config('tables.PayTypesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('pay_type_id')->unsigned()->index();
            $table->foreign('pay_type_id')->references('id')->on(config('tables.PayTypes'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('name');

            $table->primary(['pay_type_id', 'language_code'])->index();
        });
    }
}
