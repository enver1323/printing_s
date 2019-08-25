<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            /** Columns */
            $table->increments('id');
            $table->json('name');
            $table->json('description');
            $table->json('meta')->nullable();
            $table->string('slug');
            $table->integer('category_id')
                ->unsigned()
                ->nullable();
            $table->integer('brand_id')
                ->unsigned()
                ->nullable();
            $table->integer('created_by')
                ->unsigned()
                ->nullable();
            $table->float('lat');
            $table->float('lng');
            $table->integer('created_at')->unsigned();
            $table->integer('updated_at')->unsigned();

            /** Foreign keys */
            $table->foreign('category_id')
                ->on('categories')
                ->references('id')
                ->onDelete('set null');
            $table->foreign('brand_id')
                ->on('brands')
                ->references('id')
                ->onDelete('set null');
            $table->foreign('created_by')
                ->on('users')
                ->references('id')
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
