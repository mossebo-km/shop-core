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
            $table->string('address', 512)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('post_code', 255)->nullable();
            $table->string('password');
            $table->string('api_token', 60)->unique();
            $table->boolean('is_franchisee')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->integer('msb')->unsigned();
        });
    }
}
