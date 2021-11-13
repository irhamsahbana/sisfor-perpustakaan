<?php

namespace App\Http\Controllers; // Mengambil namespace App\Http\Controllers

use Illuminate\Http\Request; // untuk menggunakan request dari laravel framework 
use Illuminate\Support\Facades\DB; // untuk menggunakan DB dari laravel framework

class BukuController extends Controller //catatan 
{
    public function index()
    {
        $buku = DB::table('buku')->get();
        return view('contents.buku', compact('buku'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|date',
            'tebal' => 'required|max:255',
            'isbn' => 'required|max:255',
            'stok_buku' => 'required|integer',
            'biaya_sewa_harian' => 'required|numeric',
        ], [
            'judul_buku.required' => 'Judul buku tidak boleh kosong.',
            'pengarang.required' => 'Pengarang tidak boleh kosong.',
            'penerbit.required' => 'Penerbit tidak boleh kosong.',
            'tahun_terbit.required' => 'Pengarang tidak boleh kosong.',
            'tebal.required' => 'Tebal tidak boleh kosong.',
            'isbn.required' => 'ISBN tidak boleh kosong.',
            'stok_buku.required' => 'Stok Buku tidak boleh kosong.',
            'stok_buku.integer' => 'Stok Buku harus angka.',
            'biaya_sewa_harian.required' => 'Biaya Sewa Harian tidak boleh kosong.',
            'biaya_sewa_harian.numeric' => 'Biaya Sewa Harian harus angka.',
           
        ]);

        DB::table('buku')->insert([
            'judul_buku' => $request->judul_buku,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'tebal' => $request->tebal,
            'isbn' => $request->isbn,
            'stok_buku' => $request->stok_buku,
            'biaya_sewa_harian' => $request->biaya_sewa_harian,
        ]);

        return redirect()->route('buku.content')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Tambah data sukses.',
            'f_msg' => 'Data buku berhasil ditambahkan.',
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul_buku' => 'required|string',
            'pengarang' => 'required',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|date',
            'tebal' => 'required|max:255',
            'isbn' => 'required|max:255',
            'stok_buku' => 'required|integer',
            'biaya_sewa_harian' => 'required|numeric',

        ], [
            'judul_buku.required' => 'Judul buku tidak boleh kosong.',
            'pengarang.required' => 'Pengarang tidak boleh kosong.',
            'penerbit.required' => 'Penerbit tidak boleh kosong.',
            'tahun_terbit.required' => 'Pengarang tidak boleh kosong.',
            'tebal.required' => 'Tebal tidak boleh kosong.',
            'isbn.required' => 'ISBN tidak boleh kosong.',
            'stok_buku.required' => 'Stok Buku tidak boleh kosong.',
            'stok_buku.integer' => 'Stok Buku harus angka.',
            'biaya_sewa_harian.required' => 'Biaya Sewa Harian tidak boleh kosong.',
            'biaya_sewa_harian.numeric' => 'Biaya Sewa Harian harus angka.',
        ]);

        DB::table('buku')->where('id', $id)->update([
            'judul_buku' => $request->judul_buku,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'tebal' => $request->tebal,
            'isbn' => $request->isbn,
            'stok_buku' => $request->stok_buku,
            'biaya_sewa_harian' => $request->biaya_sewa_harian,
        ]);

        return redirect()->route('buku.content')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Sunting data sukses.',
            'f_msg' => 'Data buku berhasil disunting.',
        ]);
    }

    public function delete($id)
    {
        try { // try untuk menghandle error exception ketika data tidak ditemukan pada database atau sedang dipakai oleh tabel lain.
            DB::table('buku')->where('id', $id)->delete();
            return redirect()->route('buku.content')->with([
                'f_bg' => 'bg-success',
                'f_title' => 'Hapus data sukses.',
                'f_msg' => 'Data buku berhasil dihapus.',
            ]);
        } catch (\Exception $e) { // catch untuk menangani error exception ketika data tidak ditemukan pada database atau sedang dipakai oleh tabel lain.
            return redirect()->route('buku.content')->with([
                'f_bg' => 'bg-danger',
                'f_title' => 'Hapus data gagal.',
                'f_msg' => 'Data buku gagal dihapus.',
            ]);
        }
    }
}
