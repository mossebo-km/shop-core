<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        echo "Create Products Table\r\n";

        $tableName = config('tables.Products');

        Schema::create($tableName, function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->index();
            $table->integer('supplier_id')->nullable();
            $table->integer('quantity')->nullable()->unsigned();
            $table->integer('showed')->unsigned()->default(0);
            $table->boolean('is_payable')->index()->default(0);
            $table->time('sale_time')->nullable();
            $table->boolean('enabled')->index()->default(1);

            $table->integer('width')->unsigned()->nullable();
            $table->integer('height')->unsigned()->nullable();
            $table->integer('length')->unsigned()->nullable();
            $table->integer('weight')->unsigned()->nullable();

            $table->timestamps();
            $table->timestamp('indexed_at');
        });

        $driver = DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);

        switch ($driver) {
            case 'mysql':
                DB::unprepared("ALTER TABLE {$tableName} AUTO_INCREMENT = 100000;");
                break;
            case 'pgsql':
                DB::update("ALTER SEQUENCE {$tableName}_id_seq RESTART WITH 100000;");
                break;
        }
    }
}
