<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            /**
             * Columns
             */
            $table->increments('id');
            $table->integer('category_id')
                ->unsigned()
                ->nullable();
            $table->integer('line_id')
                ->unsigned()
                ->nullable();
            $table->integer('brand_id')
                ->unsigned()
                ->nullable();
            $table->integer('name')
                ->unsigned()
                ->nullable();
            $table->integer('description')
                ->unsigned()
                ->nullable();
            $table->enum('type', ['product', 'consumable']);
            $table->integer('parent_id')
                ->unsigned()
                ->nullable();
            $table->integer('video_id')
                ->unsigned()
                ->nullable();
            $table->enum('status', ['published', 'draft']);
            $table->integer('created_at')->unsigned();
            $table->integer('views')
                ->unsigned()
                ->default(0);

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
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
            $table->foreign('line_id')
                ->references('id')
                ->on('lines')
                ->onDelete('set null');
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('set null');
            $table->foreign('parent_id')
                ->references('id')
                ->on('products')
                ->onDelete('set null');
            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
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
        Schema::dropIfExists('products');
    }
}
