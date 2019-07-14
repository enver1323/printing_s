<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            /**
             * Columns
             */
            $table->increments('id');
            $table->integer('name')
                ->unsigned()
                ->nullable();
            $table->integer('description')
                ->unsigned()
                ->nullable();
            $table->integer('image_id')
                ->unsigned()
                ->nullable();

            /**
             * Foreign keys
             */
            $table->foreign('name')
                ->references('id')
                ->on('translations')
                ->onDelete('set null');
            $table->foreign('description')
                ->references('id')
                ->on('translations')
                ->onDelete('set null');
            $table->foreign('image_id')
                ->references('id')
                ->on('images')
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
        Schema::dropIfExists('brands');
    }
}
