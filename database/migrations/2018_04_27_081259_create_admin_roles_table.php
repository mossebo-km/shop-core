<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolesTable extends Migration
{
    public function up()
    {
        echo "Create AdminRoles Table\r\n";

        Schema::create(config('tables.AdminRoles'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('importance')->default(999);
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
        });
    }
}
