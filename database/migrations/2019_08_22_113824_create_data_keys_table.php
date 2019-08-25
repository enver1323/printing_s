<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_keys', function (Blueprint $table) {
            /** Columns */
            $table->increments('id');
            $table->json('name');
            $table->boolean('is_required');
            $table->integer('category_id')->unsigned();
            $table->json('input');
            $table->string('type');

            /** Foreign Keys */
            $table->foreign('category_id')
                ->on('categories')
                ->references('id')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_keys');
    }
}
