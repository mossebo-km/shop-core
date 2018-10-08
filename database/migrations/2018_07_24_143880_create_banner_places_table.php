<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerPlacesTable extends Migration
{
    public function up()
    {
        echo "Create BannerPlaces Table\r\n";

        Schema::create(config('tables.BannerPlaces'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();
            $table->string('name')->index();
            $table->string('type')->nullable();
            $table->boolean('enabled')->default(1);
            $table->integer('position')->unsigned()->default(0);
        });
    }
}
