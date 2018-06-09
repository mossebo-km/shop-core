<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    public function up()
    {
        echo "Create Attributes Table\r\n";

        Schema::create(config('tables.Attributes'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();
            // тип фильтра
            $table->string('layout_class')->nullable();
            $table->boolean('selectable')->default(0);
            $table->boolean('enabled')->default(1);
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
        });
    }
}
