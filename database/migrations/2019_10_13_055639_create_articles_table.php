<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            /** Columns */
            $table->increments('id');
            $table->json('name');
            $table->longText('description');
            $table->string('slug');
            $table->jsonb('meta')->nullable();
            $table->string('photo')->nullable();
            $table->integer('created_by')
                ->unsigned()
                ->nullable();
            $table->integer('created_at')->unsigned();
            $table->integer('updated_at')->unsigned();

            /** Foreign Keys */
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('articles');
    }
}
