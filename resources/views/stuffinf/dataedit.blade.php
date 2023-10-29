@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Barang Masuk</h1>
    </div>

        <!-- DataTales Example -->
    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Barang Masuk</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label for="kode" class="form-label">Nama & Kode Barang</label>
                        <select class="form-control @error('kode') is-invalid @enderror" aria-label=".form-select-sm example" name="kode" id="kode">
                          <option value="">- Pilih Salah Satu -</option>
                          <option value="">PEN12</option>
                        </select>
                      </div>
                </div>
                <div class="row g-3">
                      <div class="col-md-3 mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input class="form-control @error('jumlah') is-invalid @enderror" type="text" placeholder="Ketikkan jumlah..." name="jumlah" id="jumlah">
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="kondisi" class="form-label">Kondisi</label>
                        <select class="form-control @error('kondisi') is-invalid @enderror" aria-label=".form-select-sm example" name="kondisi" id="kondisi">
                            <option value="">- Pilih Salah Satu -</option>
                            <option value="">Baru</option>
                            <option value="">Bagus</option>
                          </select>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="peruntukan" class="form-label">Peruntukan</label>
                        <input class="form-control @error('peruntukan') is-invalid @enderror" type="text" placeholder="Kegunaan" name="peruntukan" id="peruntukan">
                        @error('peruntukan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-3 mb-3">
                        <label for="Keterangan" class="form-label">Keterangan</label>
                        <input class="form-control @error('Keterangan') is-invalid @enderror" type="text" placeholder="Ketikkan Keterangan..." name="Keterangan" id="Keterangan">
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="tanggal" class="form-label">Tanggal Keluar</label>
                        <input class="form-control @error('tanggal') is-invalid @enderror" type="date" name="tanggal" id="tanggal">
                        @error('tanggal')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                </div>
                <button class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Submit</span>
                </button>
              </form>  
        </div>
    </div>
@endsection