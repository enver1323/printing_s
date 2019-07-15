<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationsEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations_entries', function (Blueprint $table) {
            /*
             * Columns
             */
            $table->increments('id');
            $table->string('language_code',2);
            $table->integer('translation_id')->unsigned();
            $table->text('entry');

            /*
             * Foreign keys
             */
            $table->foreign('language_code')
                ->references('code')
                ->on('languages')
                ->onDelete('cascade');
            $table->foreign('translation_id')
                ->references('id')
                ->on('translations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translation_entries');
    }
}
