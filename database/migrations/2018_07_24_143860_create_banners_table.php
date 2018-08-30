<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    public function up()
    {
        echo "Create Banner Table\r\n";

        Schema::create(config('tables.Banner'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->text('gradient')->nullable();
            $table->string('color')->nullable();
            $table->string('button_color')->nullable();
            $table->string('button_background_color')->nullable();

            $table->boolean('enabled')->index()->default(1);
            $table->integer('position');

            $table->timestamps();
        });
    }
}