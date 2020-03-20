<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_documents', function (Blueprint $table) {
            /** Columns */
            $table->increments('id');
            $table->unsignedInteger('page_id');
            $table->string('manual')->nullable();

            /** Relations */
            $table->foreign('page_id')
                ->references('id')
                ->on('pages')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_documents');
    }
}
