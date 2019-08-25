<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_options', function (Blueprint $table) {
            /** Columns */
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->json('name');
            $table->json('description');
            $table->integer('created_by')
                ->unsigned()
                ->nullable();
            $table->integer('created_at')->unsigned();
            $table->integer('updated_at')->unsigned();

            /** Foreign keys */
            $table->foreign('product_id')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');
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
        Schema::dropIfExists('product_options');
    }
}
