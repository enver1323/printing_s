<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefRelatedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_related_products', function (Blueprint $table) {
            /*
             * Columns
             */
            $table->integer('main_id')->unsigned();
            $table->integer('related_id')->unsigned();

            /*
             * Foreign keys
             */
            $table->foreign('main_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->foreign('related_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_related_products');
    }
}
