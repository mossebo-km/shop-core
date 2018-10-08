<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAddPriceType extends Migration
{
    public function up()
    {
        echo "Users Add Price Type Table\r\n";

        Schema::table(config('tables.Users'), function(Blueprint $table) {
            $table->integer('price_type_id')->nullable()->unsigned()->index();
            $table->foreign('price_type_id')->references('id')->on(config('tables.PriceTypes'))->onDelete('cascade');
        });
    }
}
