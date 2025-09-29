<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable(false);
            $table->text('description')->nullable();
            $table->string('poster_url', 100)->nullable();
            $table->decimal('floor_area', 8, 2)->nullable(false);
            $table->string('type', 100)->nullable(false);
            $table->integer('price')->nullable(false);
            $table->unsignedBigInteger('hotel_id')->nullable(false);
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
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
        Schema::dropIfExists('rooms');
    }
};
