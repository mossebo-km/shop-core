<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLogTable extends Migration
{
    public function up()
    {
        echo "Create AdminLog Table\r\n";

        Schema::create(config('tables.AdminLogs'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id');

            $table->integer('admin_id')->unsigned()->index();
            $table->foreign('admin_id')->references('id')->on(config('tables.Admins'));

            $table->string('type');
            $table->text('message');
            $table->timestamp('created_at');
        });
    }
}
