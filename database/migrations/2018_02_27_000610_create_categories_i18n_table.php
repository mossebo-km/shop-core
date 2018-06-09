<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesI18nTable extends Migration
{
    public function up()
    {
        echo "Create CategoriesI18n Table\r\n";

        Schema::create(config('tables.CategoriesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on(config('tables.Categories'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('title');
            $table->text('description')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->primary(['category_id', 'language_code'])->index();
        });
    }
}
