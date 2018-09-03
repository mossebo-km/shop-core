<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    public function up()
    {
        echo "Create Banners Table\r\n";

        Schema::create(config('tables.Banners'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->text('gradient')->nullable();
            $table->string('title_color')->nullable();
            $table->string('caption_color')->nullable();
            $table->string('button_color')->nullable();
            $table->string('button_background_color')->nullable();

            $table->string('small_image')->nullable();
            $table->string('mobile_image')->nullable();
            $table->string('desktop_image')->nullable();
            $table->string('background_image')->nullable();

            $table->boolean('enabled')->index()->default(1);
            $table->integer('position')->unsigned()->default(0);

            $table->timestamps();
        });
    }
}

