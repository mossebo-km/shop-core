<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryTypesI18nTable extends Migration
{
    public function up()
    {
        echo "Create DeliveryTypesI18n Table\r\n";

        Schema::create(config('tables.DeliveryTypesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('delivery_type_id')->unsigned()->index();
            $table->foreign('delivery_type_id')->references('id')->on(config('tables.DeliveryTypes'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('name');

            $table->primary(['delivery_type_id', 'language_code'])->index();
        });
    }
}
