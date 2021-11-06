<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = DB::table('mahasiswa')->get();
        return view('contents.mahasiswa', compact('mahasiswa'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'nim' => 'required|unique:mahasiswa,nim|string|max:15',
            'email' => 'required|unique:mahasiswa,email|email:dns',
            'no_telp' => 'required|unique:mahasiswa,no_telp|string|max:15',
            'prodi' => 'required|max:255',
            'jurusan' => 'required|max:255',
            'fakultas' => 'required|max:255',
        ], [
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.string' => 'Nama tidak boleh mengandung angka.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        ]);

        DB::table('mahasiswa')->insert([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'prodi' => $request->prodi,
            'jurusan' => $request->jurusan,
            'fakultas' => $request->fakultas,
        ]);

        return redirect()->route('mahasiswa.content')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Tambah data sukses.',
            'f_msg' => 'Data mahasiswa berhasil ditambahkan.',
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'nim' => "required|unique:mahasiswa,nim,$id|string|max:15",
            'email' => "required|unique:mahasiswa,email,$id|email:dns",
            'no_telp' => "required|unique:mahasiswa,no_telp,$id|string|max:15",
            'prodi' => 'required|max:255',
            'jurusan' => 'required|max:255',
            'fakultas' => 'required|max:255',
        ], [
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.string' => 'Nama tidak boleh mengandung angka.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        ]);

        DB::table('mahasiswa')->where('id', $id)->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'prodi' => $request->prodi,
            'jurusan' => $request->jurusan,
            'fakultas' => $request->fakultas,
        ]);

        return redirect()->route('mahasiswa.content')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Sunting data sukses.',
            'f_msg' => 'Data mahasiswa berhasil disunting.',
        ]);
    }

    public function delete($id)
    {
        DB::table('mahasiswa')->where('id', $id)->delete();

        return redirect()->route('mahasiswa.content')->with([
            'f_bg' => 'bg-danger',
            'f_title' => 'Hapus data sukses.',
            'f_msg' => 'Data mahasiswa berhasil dihapus.',
        ]);
    }
}
