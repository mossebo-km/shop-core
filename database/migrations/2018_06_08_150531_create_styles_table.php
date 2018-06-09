<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStylesTable extends Migration
{
    public function up()
    {
        echo "Create Styles Table\r\n";

        Schema::create(config('tables.Styles'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();
            $table->string('slug')->unique()->index();
            $table->boolean('enabled')->index()->default(1);
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
        });
    }
}