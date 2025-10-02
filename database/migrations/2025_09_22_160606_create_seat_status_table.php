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
        Schema::create('seat_status', function (Blueprint $table) {
            $table->bigIncrements('seat_status_id');
            $table->unsignedBigInteger('seat_id');
            $table->foreign('seat_id')->references('seat_id')->on('seats');
            $table->unsignedBigInteger('showtime_id');
            $table->foreign('showtime_id')->references('showtime_id')->on('showtimes');
            $table->enum('status', ['available', 'booked']);
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->foreign('user_id')->references('id')->on('acl_users');
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
        Schema::dropIfExists('seat_status');
    }
};
