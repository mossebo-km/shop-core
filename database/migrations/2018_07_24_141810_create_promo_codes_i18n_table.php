<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodesI18nTable extends Migration
{
    public function up()
    {
        echo "Create PromoCodesI18n Table\r\n";

        Schema::create(config('tables.PromoCodesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('promo_code_id')->unsigned();
            $table->foreign('promo_code_id')->references('id')->on(config('tables.PromoCodes'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('title');
            $table->text('description')->nullable();


            $table->primary(['promo_code_id', 'language_code'])->index();
        });
    }
}
