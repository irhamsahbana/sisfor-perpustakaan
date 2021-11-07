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
            'nim.required' => 'NIM tidak boleg kosong.',
            'nim.max' => 'NIM tidak boleh lebih dari 15 karakter.',
            'nim.unique' => 'NIM tidak boleh sama.',
            'email.required' => 'Email tidak boleg kosong.',
            'email.unique' => 'Email tidak boleh sama.',
            'email.dns' => 'Email harus mengandung @gmail.com.',
            'no_telp.required' => 'No Telpon tidak boleh kosong.',
            'no_telp.max' => 'No Telpon tidak boleh lebih dari 15 karakter.',
            'prodi.required' => 'Prodi tidak boleh kosong.',
            'prodi.max' => 'Prodi tidak boleh lebih dari 255 karakter.',
            'jurusan.required' => 'Jurusan tidak boleh kosong.',
            'jurusan.max' => 'Jurusan tidak boleh lebih dari 255 karakter.',
            'fakultas.required' => 'Fakultas tidak boleh kosong.',
            'fakultas.max' => 'Fakultas tidak boleh lebih dari 255 karakter.',

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
            'nim.required' => 'NIM tidak boleg kosong.',
            'nim.max' => 'NIM tidak boleh lebih dari 15 karakter.',
            'nim.unique' => 'NIM tidak boleh sama.',
            'email.required' => 'Email tidak boleg kosong.',
            'email.unique' => 'Email tidak boleh sama.',
            'email.dns' => 'Email harus mengandung @gmail.com.',
            'no_telp.required' => 'No Telpon tidak boleh kosong.',
            'no_telp.max' => 'No Telpon tidak boleh lebih dari 15 karakter.',
            'prodi.required' => 'Prodi tidak boleh kosong.',
            'prodi.max' => 'Prodi tidak boleh lebih dari 255 karakter.',
            'jurusan.required' => 'Jurusan tidak boleh kosong.',
            'jurusan.max' => 'Jurusan tidak boleh lebih dari 255 karakter.',
            'fakultas.required' => 'Fakultas tidak boleh kosong.',
            'fakultas.max' => 'Fakultas tidak boleh lebih dari 255 karakter.',
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
