<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shortKey')->unique();
            $table->string('uri');
            $table->string('scheme')->nullable();
            $table->string('host')->nullable();
            $table->unsignedInteger('port')->nullable();
            $table->string('path')->nullable();
            $table->string('query')->nullable();
            $table->string('fragment')->nullable();
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
        Schema::dropIfExists('urls');
    }
}
