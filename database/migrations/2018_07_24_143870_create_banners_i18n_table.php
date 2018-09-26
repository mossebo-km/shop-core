<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersI18nTable extends Migration
{
    public function up()
    {
        echo "Create BannersI18n Table\r\n";

        Schema::create(config('tables.BannersI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('banner_id')->unsigned();
            $table->foreign('banner_id')->references('id')->on(config('tables.Banners'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('title')->nullable();
            $table->string('caption')->nullable();
            $table->string('button')->nullable();
            $table->string('link')->nullable();

            $table->primary(['banner_id', 'language_code'])->index();
        });
    }
}
