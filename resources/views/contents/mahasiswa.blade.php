@extends('layouts.app')
@section('title','MAHASISWA')
@section('content')
  <!-- SECTION TAMPIL DATA START -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manajemen Mahasiswa</h3>
              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-create">
                Tambah Data
              </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered tjable-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Nomor Telphone</th>
                    <th>Prodi</th>
                    <th>Jurusan</th>
                    <th>Fakultas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($mahasiswa as $mhs)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $mhs->nama }}</td>
                      <td>{{ $mhs->nim }}</td>
                      <td>{{ $mhs->email }}</td>
                      <td>{{ $mhs->no_telp }}</td>
                      <td>{{ $mhs->prodi }}</td>
                      <td>{{ $mhs->jurusan }}</td>
                      <td>{{ $mhs->fakultas }}</td>
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $mhs->id }}">Sunting</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete{{ $mhs->id }}">Hapus</button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Nomor Telphone</th>
                    <th>Prodi</th>
                    <th>Jurusan</th>
                    <th>Fakultas</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- SECTION TAMPIL DATA END -->

  <!-- FORM TAMBAH DATA START -->
  <div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Mahasiswa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('mahasiswa.create') }}" method="POST">
          @csrf
          <div class="modal-body">
            {{-- <div class="card-body"> --}}
              <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}">
                </div>
              </div>

              <div class="form-group row">
                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                  <input type="text" id="nim" name="nim" class="form-control" value="{{ old('nim') }}">
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="no_telp" class="col-sm-2 col-form-label">Nomor Telpon</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="number" id="no_telp" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
                  </div>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-10">
                  <input type="text" id="prodi" name="prodi" class="form-control" value="{{ old('prodi') }}">
                </div>
              </div>
              
              <div class="form-group row">
                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                  <input type="text" id="jurusan" name="jurusan" class="form-control" value="{{ old('jurusan') }}">
                </div>
              </div>
              
              <div class="form-group row">
                <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
                <div class="col-sm-10">
                  <input type="text" id="fakultas" name="fakultas" class="form-control" value="{{ old('fakultas') }}">
                </div>
              </div>
            {{-- </div> --}}
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- FORM TAMBAH DATA END -->

  <!-- FORM HAPUS DATA START -->
  @foreach ($mahasiswa as $mhs)
    <div class="modal fade" id="modal-delete{{ $mhs->id }}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus Data Mahasiswa</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('mahasiswa.delete', ['id' => $mhs->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">
              Yakin ingin menghapus  Mahasiswa {{ $mhs->nama }}?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-danger float-right">Hapus</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  @endforeach
  <!-- FORM HAPUS DATA END -->

  <!-- FORM UPDATE DATA START -->
  @foreach($mahasiswa as $mhs)
    <div class="modal fade" id="modal-update{{ $mhs->id }}">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Sunting Data Mahasiswa</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('mahasiswa.update', ['id' => $mhs->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
              {{-- <div class="card-body"> --}}
                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ $mhs->nama }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                  <div class="col-sm-10">
                    <input type="text" id="nim" name="nim" class="form-control" value="{{ $mhs->nim }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input type="text" id="email" name="email" class="form-control" value="{{ $mhs->email }}">
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="no_telp" class="col-sm-2 col-form-label">Nomor Telpon</label>
                  <div class="col-sm-10">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="text" id="no_telp" name="no_telp" class="form-control" value="{{ $mhs->no_telp }}">
                    </div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                  <div class="col-sm-10">
                    <input type="text" id="prodi" name="prodi" class="form-control" value="{{ $mhs->prodi }}">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                  <div class="col-sm-10">
                    <input type="text" id="jurusan" name="jurusan" class="form-control" value="{{ $mhs->jurusan }}">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
                  <div class="col-sm-10">
                    <input type="text" id="fakultas" name="fakultas" class="form-control" value="{{ $mhs->fakultas }}">
                  </div>
                </div>
              {{-- </div> --}}
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  @endforeach
  <!-- FORM UPDATE DATA END -->


@endsection
