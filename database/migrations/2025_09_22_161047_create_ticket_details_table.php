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
        Schema::create('ticket_details', function (Blueprint $table) {
            $table->bigIncrements('ticketdetail_id');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('ticket_id')->on('tickets');
            $table->unsignedBigInteger('seat_id');
            $table->foreign('seat_id')->references('seat_id')->on('seats');
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('ticket_details');
    }
};
