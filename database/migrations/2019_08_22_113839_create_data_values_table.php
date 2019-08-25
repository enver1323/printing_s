<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_values', function (Blueprint $table) {
            /** Columns */
            $table->integer('data_key')->unsigned();
            $table->integer('owner_id')->unsigned();
            $table->primary(['data_key', 'owner_id']);
            $table->json('value');
            $table->string('owner_type');

            /** Foreign keys */
            $table->foreign('data_key')
                ->on('data_keys')
                ->references('id')
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
        Schema::dropIfExists('data_values');
    }
}
