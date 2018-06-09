<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeOptionsTable extends Migration
{
    public function up()
    {
        echo "Create AttributeOptions Table\r\n";

        Schema::create(config('tables.AttributeOptions'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->integer('attribute_id')->unsigned()->index();
            $table->foreign('attribute_id')->references('id')->on(config('tables.Attributes'))->onDelete('cascade');

            $table->boolean('enabled')->index()->default(1);
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
        });
    }
}
