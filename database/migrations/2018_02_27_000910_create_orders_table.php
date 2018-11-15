<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        echo "Create Orders Table\r\n";

        Schema::create(config('tables.Orders'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('user_id')->nullable()->unsigned()->index();
            $table->foreign('user_id')->references('id')->on(config('tables.Users'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->integer('status_id')->unsigned()->index();
            $table->foreign('status_id')->references('id')->on(config('tables.OrderStatuses'));

            $table->integer('pay_type_id')->unsigned()->index();
            $table->foreign('pay_type_id')->references('id')->on(config('tables.PayTypes'));

            $table->integer('delivery_type_id')->unsigned()->index();
            $table->foreign('delivery_type_id')->references('id')->on(config('tables.DeliveryTypes'));

            $table->integer('price_type_id')->unsigned()->index();
            $table->foreign('price_type_id')->references('id')->on(config('tables.PriceTypes'));

            $table->char('currency_code', 3);
            $table->foreign('currency_code')->references('code')->on(config('tables.Currencies'));

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->string('street');
            $table->string('house_number', 64);
            $table->string('apartment', 64);
            $table->string('floor', 64);
            $table->string('entrance', 64);
            $table->string('intercom', 64);
            $table->string('post_code');
            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }
}
