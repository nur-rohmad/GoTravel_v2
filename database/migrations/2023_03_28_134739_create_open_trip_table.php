<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpenTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_trip', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 225);
            $table->text('deskripsi');
            $table->string('poster', 200);
            $table->integer('jumlah_peserta');
            $table->dateTime('tgl_berangkat');
            $table->string('lokasi_tujuan');
            $table->float('harga');
            $table->integer('lama_open_trip');
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
        Schema::dropIfExists('open_trip');
    }
}
