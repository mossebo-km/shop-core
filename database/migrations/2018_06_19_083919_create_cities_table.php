<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    public function up()
    {
        echo "Create Cities Table\r\n";

        Schema::create(config('tables.Cities'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->string('postal_code')->index();

            $table->string('lat')->nullable();
            $table->string('lon')->nullable();

            $table->string('phone')->nullable();

            $table->char('country_code', 2)->nullable()->index();
            $table->foreign('country_code')->references('code')->on(config('tables.Countries'))->onDelete('set null');

            $table->boolean('enabled')->index()->default(1);
            $table->integer('position')->unsigned()->default(0);

            $table->timestamps();
        });
    }
}
