<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolePermissionsTable extends Migration
{
    public function up()
    {
        echo "Create AdminRolePermissions Table\r\n";

        Schema::create(config('tables.AdminRolePermissions'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->string('name');
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
        });
    }
}
