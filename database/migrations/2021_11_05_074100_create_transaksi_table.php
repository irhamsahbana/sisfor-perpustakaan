<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa')->references('id')->on('mahasiswa');
            $table->foreignId('id_buku')->references('id')->on('buku');
            $table->datetime('tanggal_pinjam');
            $table->datetime('tanggal_kembali')->nullable();
            $table->boolean('status_pinjam');
            $table->decimal('total_biaya', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
