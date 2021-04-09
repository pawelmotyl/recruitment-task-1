<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('url', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('culture', 255)->nullable();
            $table->string('born', 255)->nullable();
            $table->string('died', 255)->nullable();
            $table->string('father', 255)->nullable();
            $table->string('mother', 255)->nullable();
            $table->string('spouse', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
