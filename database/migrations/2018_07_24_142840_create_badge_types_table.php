<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadgeTypesTable extends Migration
{
    public function up()
    {
        echo "Create BadgeTypes Table\r\n";

        Schema::create(config('tables.BadgeTypes'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->string('icon')->nullable();
            $table->string('color')->nullable();

            $table->boolean('has_value')->default(false);
            $table->integer('position')->unsigned()->default(0);

            $table->timestamps();
        });
    }
}
