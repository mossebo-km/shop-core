<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        echo "Create Settings Table\r\n";

        Schema::create(config('tables.Settings'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('key')->primary()->index();
            $table->text('value');
            $table->integer('position')->unsigned()->default(0);
        });
    }
}
