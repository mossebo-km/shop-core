<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRoleRelationsTable extends Migration
{
    public function up()
    {
        echo "Create AdminRoleRelations Table\r\n";

        Schema::create(config('tables.AdminRoleRelations'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('admin_id')->unsigned()->index();
            $table->foreign('admin_id')->references('id')->on(config('tables.Admins'))->onDelete('cascade');

            $table->integer('admin_role_id')->unsigned()->index();
            $table->foreign('admin_role_id')->references('id')->on(config('tables.AdminRoles'))->onDelete('cascade');

            $table->primary(['admin_id', 'admin_role_id']);
        });
    }
}
