<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            /** Columns */
            $table->increments('id');
            $table->json('name');
            $table->json('description');
            $table->json('meta')->nullable();
            $table->integer('category_id')->unsigned();
            $table->string('slug');
            $table->string('photo')->nullable();
            $table->integer('created_at');
            $table->integer('updated_at');

            /** Foreign keys */
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
        Schema::dropIfExists('brands');
    }
}
