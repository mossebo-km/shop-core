<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadgesTable extends Migration
{
    public function up()
    {
        echo "Create Badges Table\r\n";

        Schema::create(config('tables.Badges'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();


            $table->morphs('item');

            $table->integer('badge_type_id')->unsigned()->index();
            $table->foreign('badge_type_id')->references('id')->on(config('tables.BadgeTypes'))->onDelete('cascade');

            $table->string('value')->nullable();

            $table->timestamps();
        });
    }
}
