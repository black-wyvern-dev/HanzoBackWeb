<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shill', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('handle')->unique();
            $table->string('content')->nullable(true);
            $table->string('image')->nullable(true);
            $table->string('avatar')->nullable(true);
            $table->unsignedBigInteger('comment')->default(0);
            $table->unsignedBigInteger('retweet')->default(0);
            $table->unsignedBigInteger('heart')->default(0);
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
        Schema::dropIfExists('shill');
    }
}
