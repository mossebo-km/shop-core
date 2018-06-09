<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialProvidersTable extends Migration
{
    public function up()
    {
        echo "Create SocialProviders Table\r\n";

        Schema::create(config('tables.SocialProviders'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on(config('tables.Users'))->onDelete('cascade');

            $table->string('provider_user_id')->index();
            $table->string('provider')->index();
            $table->timestamps();
        });
    }
}
