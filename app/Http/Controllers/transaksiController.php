<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = DB::table('transaksi')->get();
        $mahasiswa = DB::table('mahasiswa')->get();
        $buku = DB::table('buku')->where('stok_buku', '>', 0)->get();

        $transaksi = DB::table('transaksi')
        ->leftJoin('mahasiswa', 'mahasiswa.id', '=', 'transaksi.id_mahasiswa')
        ->leftJoin('buku', 'buku.id', '=', 'transaksi.id_buku')
        ->select('transaksi.*', 'mahasiswa.nama', 'buku.judul_buku')
        ->get();
        
        return view('contents.transaksi', compact('transaksi', 'mahasiswa', 'buku'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'id_mahasiswa' => 'required',
            'id_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'status_pinjam' => 'required',
        ], [
            'tanggal_pinjam.required' => 'Tanggal pinjam tidak boleh kosong.',
            'status_pinjam.required' => 'Status pinjam tidak boleh kosong.',
            'total_biaya.required' => 'Total Biaya tidak boleh kosong.',
        ]);

        $date = date_create($request->tanggal_pinjam);
        $date = date_format($date,"Y/m/d H:i:s");

        DB::table('transaksi')->insert([
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => $date,
            'status_pinjam' => 0,
            'total_biaya' => 0,
        ]);

        $buku = DB::table('buku')->where('id', $request->id_buku)->first();
        DB::table('buku')->where('id', $request->id_buku)->update(['stok_buku' => $buku->stok_buku-1]);

        return redirect()->route('transaksi.content')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Tambah data sukses.',
            'f_msg' => 'Data transaksi berhasil ditambahkan.',
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_mahasiswa' => 'required',
            'id_buku' => 'required',
            'status_pinjam' => 'required',
            'tanggal_kembali' => 'nullable|required_if:status_pinjam,1|date',
        ], [
            'tanggal_pinjam.required' => 'Tanggal pinjam tidak boleh kosong.',
            'status_pinjam.required' => 'Status pinjam tidak boleh kosong.',
            'total_biaya.required' => 'Total Biaya tidak boleh kosong.',
        ]);
        $borrowDate = date_create($request->tanggal_pinjam); //fungsi ini untuk mengubah format tanggal

        $transaksi_lama = DB::table('transaksi')->where('id', $id)->first(); //mengambil data transaksi yang akan di update dari database
        
        if(!empty($request->tanggal_kembali) && $request->status_pinjam == 1){ //catatan: jika status pinjam = 1, maka tanggal kembali tidak boleh kosong dan harus berupa tanggal yang benar (tanggal_kembali harus lebih besar dari tanggal_pinjam) 
            $returnDate = date_create($request->tanggal_kembali); //fungsi ini untuk mengubah format tanggal kembali dari frontend ke format yang bisa di input ke database
            $diff  = date_diff( $borrowDate, $returnDate ); //fungsi ini untuk menghitung selisih tanggal antara tanggal pinjam dan tanggal kembali
            
            $buku_dipinjam = DB::table('buku')->where('id', $request->id_buku)->first(); // mengambil data buku yang dipinjam dari database
            $totalBiaya = $buku_dipinjam->biaya_sewa_harian * ($diff->format('%a')); // menghitung biaya sewa per hari dari data buku yang dipinjam


            // $transaksi_lama = DB::table('transaksi')->where('id', $id)->first();
            $buku_lama = DB::table('buku')->where('id', $transaksi_lama->id_buku)->first();

            if($transaksi_lama->id_buku == $request->id_buku) { //catatan: jika id_buku tidak berubah, maka tidak perlu update stok buku. dan jika id_buku berubah, maka perlu update stok buku. 
                DB::table('buku')->where('id', $request->id_buku)->update(['stok_buku' => $buku_lama->stok_buku + 1]);
            }

            DB::table('transaksi')->where('id', $id)->update([ //berfungsi untuk mengupdate data transaksi yang lama dengan data baru.
                'id_mahasiswa' => $request->id_mahasiswa,
                'id_buku' => $request->id_buku,
                'tanggal_pinjam' => $borrowDate,
                'tanggal_kembali' => $returnDate,
                'status_pinjam' => 1,
                'total_biaya' => $totalBiaya,
            ]);

            return redirect()->route('transaksi.content')->with([
                'f_bg' => 'bg-success',
                'f_title' => 'Sunting data sukses.',
                'f_msg' => 'Data transaksi berhasil disunting.',
            ]);
        }

        $buku_lama = DB::table('buku')->where('id', $transaksi_lama->id_buku)->first();
        $buku_baru = DB::table('buku')->where('id', $request->id_buku)->first();
        if($transaksi_lama->id_buku != $request->id_buku) {
            DB::table('buku')->where('id', $transaksi_lama->id_buku)->update(['stok_buku' => $buku_lama->stok_buku + 1]);
            DB::table('buku')->where('id', $request->id_buku)->update(['stok_buku' => $buku_baru->stok_buku - 1]);
        }

        DB::table('transaksi')->where('id', $id)->update([
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_buku' => $request->id_buku,
        ]);

        return redirect()->route('transaksi.content')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Sunting data sukses.',
            'f_msg' => 'Data transaksi berhasil disunting.',
        ]);
    }

    public function delete($id)
    {
        DB::table('transaksi')->where('id', $id)->delete();

        return redirect()->route('transaksi.content')->with([
            'f_bg' => 'bg-danger',
            'f_title' => 'Hapus data sukses.',
            'f_msg' => 'Data transaksi berhasil dihapus.',
        ]);
    }
}
