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
            $table->bigInteger('amount');
            $table->enum('metode_pembayaran', ['va_account', 'qris']);
            $table->string('bank', 50);
            $table->string('va_number', 200);
            $table->dateTime('waktu_bayar');
            $table->dateTime('waktu_expired');
            $table->string('pay_url', 225);
            $table->string('petunjuk_pembayaran', 200);
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
        Schema::dropIfExists('invoices');
    }
}
