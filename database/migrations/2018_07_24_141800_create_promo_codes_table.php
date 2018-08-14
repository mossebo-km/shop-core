<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodesTable extends Migration
{
    public function up()
    {
        echo "Create PromoCodes Table\r\n";

        Schema::create(config('tables.PromoCodes'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->string('name')->unique()->index();
            $table->timestamp('date_start');
            $table->timestamp('date_finish');
            $table->integer('quantity');
            $table->integer('quantity_per_user');

            $table->integer('amount');
            $table->integer('percent');
            $table->char('currency_code', 3)->nullable();
            $table->foreign('currency_code')->references('code')->on(config('tables.Currencies'))->onDelete('cascade');

            $table->boolean('enabled')->index()->default(1);
            $table->integer('position')->unsigned()->default(0);

            $table->timestamps();
        });
    }
}
