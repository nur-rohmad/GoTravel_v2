<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id', 30)->primary();
            $table->string('id_booking', 30);
            $table->bigInteger('id_chanel_pembayaran');
            $table->bigInteger('amount');
            $table->enum('metode_pembayaran', ['bank_transfer', 'va_account', 'qris', 'gopay', 'cstore']);
            $table->string('bank', 50);
            $table->string('va_number', 200)->nullable();
            $table->dateTime('waktu_bayar')->nullable();
            $table->dateTime('waktu_expired')->nullable();
            $table->string('pay_url', 225)->nullable();
            $table->string('petunjuk_pembayaran', 200)->nullable();
            $table->timestamps();

            $table->foreign('id_booking')->references('id')->on('bookings');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
