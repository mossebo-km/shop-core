<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteriorsI18nTable extends Migration
{
    public function up()
    {
        echo "Create InteriorsI18n Table\r\n";

        Schema::create(config('tables.InteriorsI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('interior_id')->unsigned();
            $table->foreign('interior_id')->references('id')->on(config('tables.Interiors'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('title')->nullable();

            $table->primary(['interior_id', 'language_code'])->index();
        });
    }
}
