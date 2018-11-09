<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        echo "Create Categories Table\r\n";

        Schema::create(config('tables.Categories'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();
            $table->nestedSet();
            $table->string('slug')->unique()->index();
            $table->boolean('enabled')->index()->default(1);
            $table->integer('position')->unsigned()->default(0);

            $table->boolean('is_popular')->default(0);
            $table->string('miniature_image')->nullable();
            $table->timestamps();
        });
    }
}
