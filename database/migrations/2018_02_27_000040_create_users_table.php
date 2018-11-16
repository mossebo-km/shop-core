<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        echo "Create Users Table\r\n";

        Schema::create(config('tables.Users'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->index();
            $table->string('phone')->unique()->index()->nullable();
            $table->string('password');
            $table->string('api_token', 60)->unique();
            $table->boolean('is_franchisee')->default(false);


            $table->string('city', 255)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('house_number', 255)->nullable();
            $table->string('apartment', 255)->nullable();
            $table->string('floor', 255)->nullable();
            $table->string('entrance', 255)->nullable();
            $table->string('intercom', 255)->nullable();
            $table->string('post_code', 255)->nullable();

            $table->rememberToken();
            $table->timestamps();

            $table->integer('msb')->unsigned();
        });
    }
}
