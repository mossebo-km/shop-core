<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoUsesTable extends Migration
{
    public function up()
    {
        echo "Create PromoUses Table\r\n";

        Schema::create(config('tables.PromoUses'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->integer('promo_code_id')->unsigned()->index();
            $table->foreign('promo_code_id')->references('id')->on(config('tables.PromoCodes'))->onDelete('set null');

            $table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')->on(config('tables.Orders'))->onDelete('cascade');

            $table->integer('user_id')->nullable()->unsigned()->index();
            $table->foreign('user_id')->references('id')->on(config('tables.Users'))->onDelete('cascade');

            $table->integer('amount')->nullable();
            $table->integer('percent')->nullable();
            $table->char('currency_code', 3)->nullable();
            $table->foreign('currency_code')->references('code')->on(config('tables.Currencies'))->onDelete('cascade');

            $table->timestamps();
        });
    }
}
