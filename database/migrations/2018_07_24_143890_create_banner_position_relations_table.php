<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerPositionRelationsTable extends Migration
{
    public function up()
    {
        echo "Create BannerPositionRelations Table\r\n";

        Schema::create(config('tables.BannerPositionRelations'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('banner_id')->unsigned();
            $table->foreign('banner_id')->references('id')->on(config('tables.Banners'))->onDelete('cascade');

            $table->integer('position_id')->unsigned();
            $table->foreign('position_id')->references('id')->on(config('tables.BannerPositions'))->onDelete('cascade');

            $table->primary(['banner_id', 'position_id'])->index();
        });
    }
}
