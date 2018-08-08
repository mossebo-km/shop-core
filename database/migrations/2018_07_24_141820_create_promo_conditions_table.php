<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoConditionsTable extends Migration
{
    public function up()
    {
        echo "Create PromoConditions Table\r\n";

        Schema::create(config('tables.PromoConditions'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->integer('promo_code_id')->unsigned()->index();
            $table->foreign('promo_code_id')->references('id')->on(config('tables.PromoCodes'))->onDelete('cascade');

            $table->string('type');
            $table->text('params');
        });
    }
}
