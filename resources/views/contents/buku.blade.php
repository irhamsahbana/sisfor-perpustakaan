@extends('layouts.app')
@section('title','BUKU')

@section('content')
  <!-- SECTION TAMPIL DATA START -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manajemen Buku</h3>
              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-create">
                Tambah Data
              </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('layouts.alert-message')
              <table id="example1" class="table table-bordered tjable-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Tebal</th>
                    <th>ISBN</th>
                    <th>Stok buku</th>
                    <th>Biaya Sewa Harian</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($buku as $b)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $b->judul_buku }}</td>
                      <td>{{ $b->pengarang }}</td>
                      <td>{{ $b->penerbit }}</td>
                      <td>{{ $b->tahun_terbit }}</td>
                      <td>{{ $b->tebal }}</td>
                      <td>{{ $b->isbn }}</td>
                      <td>{{ $b->stok_buku }}</td>
                      <td>{{ $b->biaya_sewa_harian }}</td>
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $b->id }}">Sunting</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete{{ $b->id }}">Hapus</button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Tebal</th>
                    <th>ISBN</th>
                    <th>Stok buku</th>
                    <th>Biaya Sewa Harian</th>
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
          <h4 class="modal-title">Tambah Data Buku</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('buku.create') }}" method="POST">
          @csrf
          <div class="modal-body">
            {{-- <div class="card-body"> --}}
              <div class="form-group row">
                <label for="judul_buku" class="col-sm-2 col-form-label">Judul Buku</label>
                <div class="col-sm-10">
                  <input type="text" id="judul_buku" name="judul_buku" class="form-control" value="{{ old('judul_buku') }}">
                </div>
              </div>

              <div class="form-group row">
                <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                <div class="col-sm-10">
                  <input type="text" id="pengarang" name="pengarang" class="form-control" value="{{ old('pengarang') }}">
                </div>
              </div>

              <div class="form-group row">
                <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-10">
                  <input type="text" id="penerbit" name="penerbit" class="form-control" value="{{ old('penerbit') }}">
                </div>
              </div>

              <div class="form-group row">
                <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun terbit</label>
                <div class="col-sm-10">
                  <input type="date" id="tahun_terbit" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}">
                </div>
              </div>
              
              <div class="form-group row">
                <label for="tebal" class="col-sm-2 col-form-label">Tebal</label>
                <div class="col-sm-10">
                  <input type="text" id="tebal" name="tebal" class="form-control" value="{{ old('tebal') }}">
                </div>
              </div>
              
              <div class="form-group row">
                <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                <div class="col-sm-10">
                  <input type="text" id="isbn" name="isbn" class="form-control" value="{{ old('isbn') }}">
                </div>
              </div>
              
              <div class="form-group row">
                <label for="stok_buku" class="col-sm-2 col-form-label">Stok buku</label>
                <div class="col-sm-10">
                  <input type="number" id="stok_buku" name="stok_buku" class="form-control" value="{{ old('stok_buku') }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="biaya_sewa_harian" class="col-sm-2 col-form-label">Biaya Sewa Harian</label>
                <div class="col-sm-10">
                  <input type="nimber" id="biaya_sewa_harian" name="biaya_sewa_harian" class="form-control" value="{{ old('biaya_sewa_harian') }}">
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

  <!-- HAPUS DATA START -->
  @foreach ($buku as $b)
    <div class="modal fade" id="modal-delete{{ $b->id }}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus Data Buku</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('buku.delete', ['id' => $b->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">
              Yakin ingin menghapus buku {{ $b->judul_buku }}?
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
  <!-- HAPUS DATA END -->

  <!-- UPDATE DATA START -->
  @foreach($buku as $b)
    <div class="modal fade" id="modal-update{{ $b->id }}">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Sunting Data Buku</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('buku.update', ['id' => $b->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
              {{-- <div class="card-body"> --}}
                <div class="form-group row">
                  <label for="judul_buku" class="col-sm-3 col-form-label">Judul Buku</label>
                  <div class="col-sm-9">
                    <input type="text" id="judul_buku" name="judul_buku" class="form-control" value="{{ $b->judul_buku }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
                  <div class="col-sm-9">
                    <input type="text" id="pengarang" name="pengarang" class="form-control" value="{{ $b->pengarang }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                  <div class="col-sm-9">
                    <input type="text" id="penerbit" name="penerbit" class="form-control" value="{{ $b->penerbit }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
                  <div class="col-sm-9">
                    <input type="date" id="tahun_terbit" name="tahun_terbit" class="form-control" value="{{ $b->tahun_terbit }}">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="tebal" class="col-sm-3 col-form-label">Tebal</label>
                  <div class="col-sm-9">
                    <input type="text" id="tebal" name="tebal" class="form-control" value="{{ $b->tebal }}">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="isbn" class="col-sm-3 col-form-label">ISBN</label>
                  <div class="col-sm-9">
                    <input type="text" id="isbn" name="isbn" class="form-control" value="{{ $b->isbn }}">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="stok_buku" class="col-sm-3 col-form-label">Stok Buku</label>
                  <div class="col-sm-9">
                    <input type="number" id="stok_buku" name="stok_buku" class="form-control" value="{{ $b->stok_buku }}">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="biaya_sewa_harian" class="col-sm-3 col-form-label">Biaya Sewa Harian</label>
                    <div class="col-sm-9">
                      <input type="number" id="biaya_sewa_harian" name="biaya_sewa_harian" class="form-control" value="{{ $b->biaya_sewa_harian }}">
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
  <!-- UPDATE DATA START -->


@endsection
