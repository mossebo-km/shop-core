<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        echo "Create Admins Table\r\n";

        Schema::create(config('tables.Admins'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->string('api_token', 60)->unique();
            $table->string('name');
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->boolean('enabled')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }
}
