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
            $table->integer('id')->unsigned();
            $table->string('name')->index();
        });
    }
}
