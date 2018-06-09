<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolePermissionGroupsTable extends Migration
{
    public function up()
    {
        echo "Create AdminRolePermissionGroups Table\r\n";

        Schema::create(config('tables.AdminRolePermissionGroups'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->string('namespace')->nullable();
            $table->nestedSet();
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
        });
    }
}
