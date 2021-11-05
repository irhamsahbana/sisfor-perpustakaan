<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->text('judul_buku');
            $table->text('pengarang');
            $table->string('penerbit');
            $table->date('tahun_terbit');
            $table->string('tebal');
            $table->string('isbn');
            $table->integer('stok_buku');
            $table->decimal('biaya_sewa_harian',$precision = 12, $scale = 2);
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
        Schema::dropIfExists('buku');
    }
}
