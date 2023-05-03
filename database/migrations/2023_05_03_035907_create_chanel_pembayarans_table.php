<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChanelPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chanel_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_type', ['bank_transfer', 'gopay', 'cstore']);
            $table->string('name', 200);
            $table->string('payment_code', 200);
            $table->string('image', 200);
            $table->enum('status', ['active', 'nonaktif']);
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
        Schema::dropIfExists('chanel_pembayarans');
    }
}
