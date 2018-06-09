<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolePermissionRelationsTable extends Migration
{
    public function up()
    {
        echo "Create AdminRolePermissionRelations Table\r\n";

        Schema::create(config('tables.AdminRolePermissionRelations'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('admin_role_id')->unsigned()->index();
            $table->foreign('admin_role_id')->references('id')->on(config('tables.AdminRoles'))->onDelete('cascade');

            $table->integer('admin_role_permission_group_id')->unsigned()->index();
            $table->foreign('admin_role_permission_group_id')->references('id')->on(config('tables.AdminRolePermissionGroups'))->onDelete('cascade');

            $table->integer('admin_role_permission_id')->unsigned()->index();
            $table->foreign('admin_role_permission_id')->references('id')->on(config('tables.AdminRolePermissions'))->onDelete('cascade');

            $table->primary(['admin_role_id', 'admin_role_permission_id']);
        });
    }
}
