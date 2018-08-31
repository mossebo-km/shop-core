<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerPositionsTable extends Migration
{
    public function up()
    {
        echo "Create BannerPositions Table\r\n";

        Schema::create(config('tables.BannerPositions'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('banner_id')->unsigned();
            $table->foreign('banner_id')->references('id')->on(config('tables.Banner'))->onDelete('cascade');

            $table->string('position_name')->index();
        });
    }
}
