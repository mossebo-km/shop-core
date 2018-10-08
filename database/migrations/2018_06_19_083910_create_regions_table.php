<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    public function up()
    {
        echo "Create Regions Table\r\n";

        Schema::create(config('tables.Regions'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->char('country_code', 2)->nullable()->index();
            $table->foreign('country_code')->references('code')->on(config('tables.Countries'))->onDelete('set null');

            $table->string('name')->nullable();
            $table->string('short_name')->nullable();

            $table->string('fias_code')->nullable();
            $table->string('okato_code')->nullable();
            $table->string('aoguid');
            $table->nestedSet();

            $table->boolean('enabled')->index()->default(1);

            $table->timestamps();
        });
    }
}
