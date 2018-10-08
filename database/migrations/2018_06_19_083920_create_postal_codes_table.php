<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostalCodesTable extends Migration
{
    public function up()
    {
        echo "Create PostalCodes Table\r\n";

        Schema::create(config('tables.PostalCodes'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->morphs('item');

            $table->string('code')->unique()->index();
        });
    }
}
