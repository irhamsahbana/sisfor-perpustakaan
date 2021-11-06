<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = DB::table('transaksi')->get();
        return view('contents.transaksi', compact('transaksi'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'judul_buku' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'status_pinjam' => 'required',
            'total_biaya' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.string' => 'Nama tidak boleh mengandung angka.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        ]);

        DB::table('transaksi')->insert([
            'nama' => $request->nama,
            'judul_buku' => $request->judul_buku,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status_pinjam' => $request->status_pinjam,
            'total_biaya' => $request->total_biaya,
        ]);

        return redirect()->route('transaksi.content')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Tambah data sukses.',
            'f_msg' => 'Data transaksi berhasil ditambahkan.',
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'judul_buku' => "required|",
            'tanggal_pinjam' => "required|date",
            'tanggal_kembali' => "required|date",
            'status_pinjam' => 'required',
            'total_biaya' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.string' => 'Nama tidak boleh mengandung angka.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        ]);

        DB::table('transaksi')->where('id', $id)->update([
            'nama' => $request->nama,
            'judul_buku' => $request->judul_buku,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status_pinjam' => $request->status_pinjam,
            'total_biaya' => $request->total_biaya,
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
