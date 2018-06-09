<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    public function up()
    {
        echo "Create PasswordResets Table\r\n";

        Schema::create(config('tables.PasswordResets'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }
}
