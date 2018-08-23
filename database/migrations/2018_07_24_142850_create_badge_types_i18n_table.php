<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadgeTypesI18nTable extends Migration
{
    public function up()
    {
        echo "Create BadgeTypesI18n Table\r\n";

        Schema::create(config('tables.BadgeTypesI18n'), function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->integer('badge_type_id')->unsigned();
            $table->foreign('badge_type_id')->references('id')->on(config('tables.BadgeTypes'))->onDelete('cascade');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->string('title');

            $table->primary(['badge_type_id', 'language_code'])->index();
        });
    }
}
