<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteriorsTable extends Migration
{
    public function up()
    {
        echo "Create Interiors Table\r\n";

        Schema::create(config('tables.Interiors'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->string('image');

            $table->timestamps();
        });
    }
}
