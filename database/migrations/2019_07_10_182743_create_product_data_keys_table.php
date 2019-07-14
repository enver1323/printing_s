<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDataKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_data_keys', function (Blueprint $table) {
            /**
             * Columns
             */
            $table->increments('id');
            $table->integer('name')
                ->unsigned()
                ->nullable();

            /**
             * Foreign keys
             */
            $table->foreign('name')
                ->references('id')
                ->on('translations')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_data_keys');
    }
}
