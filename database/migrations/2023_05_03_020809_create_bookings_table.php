<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->uuid('id_openTrip');
            $table->string('id_invoice', 30);
            $table->string('email_tujuan', 100);
            $table->integer('jumlah_booking');
            $table->enum('status', ['proses', 'gagal', 'berhasil']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_openTrip')->references('id')->on('open_trip');
            $table->foreign('id_invoice')->references('id')->on('invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
