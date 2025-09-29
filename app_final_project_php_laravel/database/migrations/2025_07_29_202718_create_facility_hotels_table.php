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
        Schema::create('facility_hotels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facility_id')->nullable(false);
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
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
        Schema::dropIfExists('facility_hotels');
    }
};
