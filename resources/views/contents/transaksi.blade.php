@extends('layouts.app')
@section('title','TRANSAKSI')
@section('content')
  <!-- SECTION TAMPIL DATA START -->
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
              @include('layouts.alert-message')
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
                      <td>@if($t->status_pinjam == 0) Dipinjam @elseif($t->status_pinjam == 1) Dikembalikan @endif </td>
                      <td>{{ number_format($t->total_biaya, 2) }}</td>
                      <td>
                        @if($t->status_pinjam != 1)
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update{{ $t->id }}">Sunting</button>
                        @endif
                        @if($t->status_pinjam != 0 )
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete{{ $t->id }}">Hapus</button>
                        @endif
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
  <!-- SECTION TAMPIL DATA END -->

  <!-- TAMBAH DATA START -->
  <div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-md">
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
                  <select class="form-control" name="id_mahasiswa">
                    <option value="">-- Pilih Salah satu --</option>
                    @foreach($mahasiswa as $mhs)
                      <option value="{{ $mhs->id }}" {{ old('id_mahasiswa') == $mhs->id ? "selected":""}}>{{ $mhs->nama }}</option> <!-- catatn: ini adalah cara membuat value default -->
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="judul_buku" class="col-sm-2 col-form-label">Judul Buku</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_buku">
                    <option value="">-- Pilih Salah satu --</option>
                    @foreach($buku as $b)
                      <option value="{{ $b->id }}" {{ old('id_buku') == $b->id ? "selected":""}}>{{ $b->judul_buku }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="tanggal_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                <div class="col-sm-10">
                  <div class="input-group date" id="tanggal_pinjam" data-target-input="nearest">
                      <input type="text" name="tanggal_pinjam" class="form-control datetimepicker-input" data-target="#tanggal_pinjam"/>
                      <div class="input-group-append" data-target="#tanggal_pinjam" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                  {{-- <input type="text" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control datetimepicker-input" data-target="#reservationdatetime"> --}}
                </div>
              </div>

              {{-- <div class="form-group row">
                <label for="tanggal_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                <div class="col-sm-10">
                  <div class="input-group date" id="tanggal_kembali" data-target-input="nearest">
                    <input type="text" name="tanggal_pinjam" class="form-control datetimepicker-input" data-target="#tanggal_kembali"/>
                    <div class="input-group-append" data-target="#tanggal_kembali" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div> --}}
              
              <div class="form-group row">
                <label for="status_pinjam" class="col-sm-2 col-form-label">Status Pinjam</label>
                <div class="col-sm-10">
                  <select class="form-control" name="status_pinjam" readonly>
                    <option value="0" selected>Dipinjam</option>
                    {{-- <option value="1">Dikembalikan</option> --}}
                  </select>
                </div>
              </div>
              
              {{-- <div class="form-group row">
                <label for="total_biaya" class="col-sm-2 col-form-label">Total Biaya</label>
                <div class="col-sm-10">
                  <input type="number" id="total_biaya" name="total_biaya" class="form-control" value="0" readonly>
                </div>
              </div> --}}
            
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
  <!-- TAMBAH DATA END -->

  <!-- HAPUS DATA START -->
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
  <!-- HAPUS DATA END -->
  
  <!-- UPDATE DATA START -->
  @foreach($transaksi as $t)
    <div class="modal fade" id="modal-update{{ $t->id }}">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Sunting Data Transaksi</h4>
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
                      <select class="form-control" name="id_mahasiswa">
                        @foreach($mahasiswa as $mhs)
                          <option value="{{ $mhs->id }}" @if($mhs->id == $t->id_mahasiswa) selected  @endif>{{ $mhs->nama }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
    
                  <div class="form-group row">
                    <label for="judul_buku" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="id_buku">
                        @foreach($buku as $b)
                          <option value="{{ $b->id }}" @if($b->id == $t->id_buku) selected @endif>{{ $b->judul_buku }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
    
                  <div class="form-group row">
                    <label for="tanggal_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                    <div class="col-sm-10">
                      <div class="input-group date" id="tanggal_pinjam" data-target-input="nearest">
                          <input type="text" name="tanggal_pinjam" class="form-control datetimepicker-input" data-target="#tanggal_pinjam" value="{{ $t->tanggal_pinjam }}" readonly/>
                          <div class="input-group-append" data-target="#tanggal_pinjam" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                      {{-- <input type="text" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control datetimepicker-input" data-target="#reservationdatetime"> --}}
                    </div>
                  </div>
    
                  <div class="form-group row">
                    <label for="tanggal_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                    <div class="col-sm-10">
                      <div class="input-group date tanggal_kembali" data-target-input="nearest">
                        <input type="text" name="tanggal_kembali" class="form-control datetimepicker-input" data-target=".tanggal_kembali"/>
                        <div class="input-group-append" data-target=".tanggal_kembali" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="status_pinjam" class="col-sm-2 col-form-label">Status Pinjam</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="status_pinjam" >
                        <option value="0" selected>Dipinjam</option>
                        <option value="1">Dikembalikan</option>
                      </select>
                    </div>
                  </div>
                  
                  {{-- <div class="form-group row">
                    <label for="total_biaya" class="col-sm-2 col-form-label">Total Biaya</label>
                    <div class="col-sm-10">
                      <input type="number" id="total_biaya" name="total_biaya" class="form-control" value="0" readonly>
                    </div>
                  </div> --}}
                
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
  <!-- UPDATE DATA END -->

@endsection

@push('js')
<!-- date-range-picker -->
<script src="{{ asset('template') }}/plugins/daterangepicker/daterangepicker.js"></script>
<script>
  $('#tanggal_pinjam').datetimepicker({ icons: { time: 'far fa-clock' } })
  $('.tanggal_kembali').datetimepicker({ icons: { time: 'far fa-clock' } })
</script>
@endpush
