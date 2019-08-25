<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            /** Columns */
            $table->increments('id');
            $table->integer('country_id')
                ->unsigned()
                ->nullable();
            $table->json('name');
            $table->string('slug')->unique();
            $table->integer('parent_id')
                ->unsigned()
                ->nullable();
            $table->float('lat', 20, 10)->nullable();
            $table->float('lng', 20, 10)->nullable();

            /** Unique Columns */
            $table->unique(['country_id', 'slug', 'parent_id']);

            /** Foreign keys */
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');
            $table->foreign('parent_id')
                ->references('id')
                ->on('regions')
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
        Schema::dropIfExists('regions');
    }
}
