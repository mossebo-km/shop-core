<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    public function up()
    {
        echo "Create Suppliers Table\r\n";

        Schema::create(config('tables.Suppliers'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(1);
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
        });
    }
}
