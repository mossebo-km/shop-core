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

            $table->string('lat')->nullable();
            $table->string('lon')->nullable();

            $table->integer('region_id')->nullable()->index();
            $table->foreign('region_id')->references('id')->on(config('tables.Regions'))->onDelete('set null');

            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('fias_code')->nullable();
            $table->string('okato_code')->nullable();
            $table->string('aoguid');

            $table->boolean('enabled')->index()->default(1);
            $table->integer('position')->unsigned()->default(0);

            $table->timestamps();
            $table->timestamp('indexed_at')->nullable();
        });
    }
}
