<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            /** Columns */
            $table->increments('id');
            $table->integer('user_id')
                ->unsigned();
            $table->string('name');
            $table->string('family_name')->nullable();
            $table->integer('birth_date')->nullable();
            $table->string('photo')->nullable();
            $table->string('nickname')->nullable();
            $table->string('gender')->default('male');
            $table->integer('country_id')
                ->unsigned()
                ->nullable();
            $table->integer('created_at');
            $table->integer('updated_at');

            /**
             * Foreign keys
             */
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('set null');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
