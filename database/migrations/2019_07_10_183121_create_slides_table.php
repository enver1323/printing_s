<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            /*
             * Columns
             */
            $table->increments('id');
            $table->integer('image_id')
                ->unsigned()
                ->nullable();
            $table->integer('product_id')
                ->unsigned()
                ->nullable();
            $table->string('link')->nullable();

            /*
             * Foreign keys
             */
            $table->foreign('image_id')
                ->references('id')
                ->on('images')
                ->onDelete('set null');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::dropIfExists('slider');
    }
}
