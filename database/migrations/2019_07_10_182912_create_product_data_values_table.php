<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDataValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_data_values', function (Blueprint $table) {
            /**
             * Columns
             */
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('key_id')->unsigned();
            $table->integer('name')
                ->unsigned()
                ->nullable();

            /**
             * Foreign keys
             */
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->foreign('key_id')
                ->references('id')
                ->on('product_data_keys')
                ->onDelete('cascade');
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
        Schema::dropIfExists('product_data_values');
    }
}
