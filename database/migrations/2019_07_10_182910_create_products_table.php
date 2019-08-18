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
            $table->json('name')->nullable();
            $table->integer('description')->nullable();
            $table->enum('type', ['product', 'consumable']);
            $table->integer('parent_id')
                ->unsigned()
                ->nullable();
            $table->string('video')->nullable();
            $table->enum('status', ['published', 'draft']);
            $table->integer('views')
                ->unsigned()
                ->default(0);
            $table->integer('updated_at')->unsigned();
            $table->integer('created_at')->unsigned();

            /**
             * Foreign keys
             */
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
