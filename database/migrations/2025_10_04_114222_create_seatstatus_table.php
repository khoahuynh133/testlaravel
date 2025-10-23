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
            $table->unsignedBigInteger('showtime_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('status', ['available', 'pending', 'booked'])->default('available');

            $table->timestamps();

            $table->foreign('seat_id')->references('seat_id')->on('seats')->onDelete('cascade');
            $table->foreign('showtime_id')->references('showtime_id')->on('showtimes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->index('seat_id');
            $table->index('showtime_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_status'); // phải trùng với up()
    }
};
