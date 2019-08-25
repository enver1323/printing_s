<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->string('code', 2)->unique();
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
