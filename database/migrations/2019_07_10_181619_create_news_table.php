<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
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
            $table->integer('created_by')
                ->unsigned()
                ->nullable();
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
        Schema::dropIfExists('news');
    }
}
