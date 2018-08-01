<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCodesTable extends Migration
{
    public function up()
    {
        echo "Create PostCodes Table\r\n";

        Schema::create(config('tables.PostCodes'), function (Blueprint $table) {
            $table->string('code')->primary()->index();

            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on(config('tables.Cities'))->onDelete('cascade');
        });
    }
}
