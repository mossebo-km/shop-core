<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    public function up()
    {
        echo "Create Languages Table\r\n";

        Schema::create(config('tables.Languages'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->char('code', 2)->primary()->index();
            $table->string('name');
            $table->string('image')->nullable();

            $table->char('currency_code', 3)->nullable();
            $table->foreign('currency_code')->references('code')->on(config('tables.Currencies'))->onDelete('set null');

            $table->boolean('default')->default(0);
            $table->boolean('enabled')->default(0);
            $table->integer('position')->unsigned()->default(0);

            $table->timestamps();
        });
    }
}
