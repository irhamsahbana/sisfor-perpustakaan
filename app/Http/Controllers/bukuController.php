<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index()
    {
        $buku = DB::table('buku')->get();
        return view('contents.buku', compact('buku'));
    }

    public function create(Request $request)
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
            'judul_buku.string' => 'Nama tidak boleh mengandung angka.',
           
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
            'judul_buku.string' => 'Nama tidak boleh mengandung angka.',
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
        DB::table('buku')->where('id', $id)->delete();

        return redirect()->route('buku.content')->with([
            'f_bg' => 'bg-danger',
            'f_title' => 'Hapus data sukses.',
            'f_msg' => 'Data buku berhasil dihapus.',
        ]);
    }
}
