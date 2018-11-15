<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Create Reviews Table\r\n";

        Schema::create(config('tables.Reviews'), function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();

            $table->morphs('item');

            $table->char('language_code', 2);
            $table->foreign('language_code')->references('code')->on(config('tables.Languages'));

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on(config('tables.Users'))->onDelete('cascade');

            $table->integer('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on(config('tables.Admins'))->onDelete('set null');

            $table->integer('rate')->unsigned()->nullable();

            $table->text('advantages')->nullable();
            $table->text('disadvantages')->nullable();
            $table->text('comment');
            $table->string('usage_time');

            $table->boolean('enabled')->default(1);
            $table->boolean('confirmed')->default(0);

            $table->timestamps();
        });
    }
}
