@extends('layouts.app')

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manajemen Transaksi</h3>
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
                    <th>Nama Mahasiswa</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status Pinjam</th>
                    <th>Total biaya</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($transaksi as $t)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $t->nama }}</td>
                      <td>{{ $t->judul_buku }}</td>
                      <td>{{ $t->tanggal_pinjam }}</td>
                      <td>{{ $t->tanggal_kembali}}</td>
                      <td>{{ $t->status_pinjam }}</td>
                      <td>{{ $t->total_biaya }}</td>
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $t->id }}">Sunting</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete{{ $t->id }}">Hapus</button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status Pinjam</th>
                    <th>Total biaya</th>
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

  <div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Transaksi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('transaksi.create') }}" method="POST">
          @csrf
          <div class="modal-body">
            {{-- <div class="card-body"> --}}
              <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-10">
                    <select name="nama" id="nama"></select>
                </div>
              </div>

              <div class="form-group row">
                <label for="judul_buku" class="col-sm-2 col-form-label">Judul Buku</label>
                <div class="col-sm-10">
                    <select name="judul_buku" id="judul_buku"></select>
                </div>
              </div>

              <div class="form-group row">
                <label for="tanggal_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                <div class="col-sm-10">
                  <input type="datetime" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" value="{{ old('tanggal_pinjam') }}">
                </div>
              </div>

              <div class="form-group row">
                <label for="tanggal_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                <div class="col-sm-10">
                  <input type="datetime" id="tanggal_kembali" name="tanggal_kembali" class="form-control" value="{{ old('tanggal_kembali') }}">
                </div>
              </div>
              
              <div class="form-group row">
                <label for="status_pinjam" class="col-sm-2 col-form-label">status_pinjam</label>
                <div class="col-sm-10">
                  <select name="status_pinjam" id="status_pinjam"></select>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="total_biaya" class="col-sm-2 col-form-label">Total Biaya</label>
                <div class="col-sm-10">
                  <input type="number" id="otal_biaya" name="otal_biaya" class="form-control" value="{{ old('otal_biaya') }}">
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

  @foreach ($transaksi as $t)
    <div class="modal fade" id="modal-delete{{ $t->id }}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus Data Buku</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('transaksi.delete', ['id' => $t->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">
              Yakin ingin menghapus Transaksi {{ $t->nama }}?
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

  @foreach($transaksi as $t)
    <div class="modal fade" id="modal-update{{ $t->id }}">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Sunting Data Transaksu</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('transaksi.update', ['id' => $t->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
              {{-- <div class="card-body"> --}}
                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                  <div class="col-sm-10">
                    <select name="nama" id="nama"></select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="judul_buku" class="col-sm-2 col-form-label">Judul Buku</label>
                  <div class="col-sm-10">
                    <select name="judul_buku" id="judul_buku"></select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tanggal_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                  <div class="col-sm-10">
                    <input type="datetime" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" value="{{ $t->tanggal_pinjam }}">
                  </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                    <div class="col-sm-10">
                      <input type="datetime" id="tanggal_kembali" name="tanggal_kembali" class="form-control" value="{{ $t->tanggal_kembali }}">
                    </div>
                  </div>
                
                <div class="form-group row">
                  <label for="status_pinjam" class="col-sm-2 col-form-label">status_pinjam</label>
                  <div class="col-sm-10">
                    <select name="status_pinjam" id="status_pinjam"></select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="total_biaya" class="col-sm-2 col-form-label">total_biaya</label>
                  <div class="col-sm-10">
                    <input type="number" id="total_biaya" name="total_biaya" class="form-control" value="{{ $t->total_biaya }}">
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


@endsection
