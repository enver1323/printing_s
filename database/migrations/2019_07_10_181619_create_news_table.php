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
            $table->json('name')->nullable();
            $table->json('description')->nullable();
            $table->integer('created_by')
                ->unsigned()
                ->nullable();
            $table->integer('views')
                ->unsigned()
                ->default(0);
            $table->integer('updated_at')->unsigned();
            $table->integer('created_at')->unsigned();

            /**
             * Foreign keys
             */
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
