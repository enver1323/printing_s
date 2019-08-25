<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            /** Columns */
            $table->increments('id');
            $table->json('name');
            $table->string('slug')->unique();
            $table->string('photo')->nullable();
            $table->float('lat', 20, 10)->nullable();
            $table->float('lng', 20, 10)->nullable();
            $table->string('code', 2)->nullable();
            $table->string('phone_code', 4)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
