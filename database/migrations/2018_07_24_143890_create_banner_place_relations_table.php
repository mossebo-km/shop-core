<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerPlaceRelationsTable extends Migration
{
    public function up()
    {
        echo "Create BannerPlaceRelations Table\r\n";

        Schema::create(config('tables.BannerPlaceRelations'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('banner_id')->unsigned();
            $table->foreign('banner_id')->references('id')->on(config('tables.Banners'))->onDelete('cascade');

            $table->integer('place_id')->unsigned();
            $table->foreign('place_id')->references('id')->on(config('tables.BannerPlaces'))->onDelete('cascade');

            $table->primary(['banner_id', 'place_id'])->index();
        });
    }
}
