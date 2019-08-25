<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            /**
             * Columns
             */
            $table->increments('id');
            $table->integer('number');
            $table->boolean('verified')->default(false);
            $table->integer('profile_id')
                ->unsigned();
            $table->string('country_code', 4)
                ->nullable()
                ->references('phone_code')
                ->on('countries')
                ->onDelete('set null');

            /**
             * Foreign keys
             */
            $table->foreign('profile_id')
                ->on('profiles')
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
        Schema::dropIfExists('phones');
    }
}
