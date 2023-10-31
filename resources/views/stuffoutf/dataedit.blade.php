@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Barang Keluar</h1>
    </div>

        <!-- DataTales Example -->
    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Formulir Barang Keluar</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="/stuffout/{{ $barangKeluar->id }}">
              @method('patch')
                @csrf
                <div class="row g-3">
                  <div class="col-md-6 mb-3">
                    <label for="kodeMaterial" class="form-label">Kode - Nama Barang</label>
                    <select class="form-control @error('kodeMaterial') is-invalid @enderror" aria-label=".form-select-sm example" name="kodeMaterial" id="kodeMaterial">
                      <option value="">- Pilih Salah Satu -</option>
                      @foreach ($kodematerials as $kodematerial)
                      <option {{ (old('kodeMaterial',$barangKeluar->kodeMaterial)==$kodematerial->kodeMaterial)?"selected":"" }} value="{{ $kodematerial->kodeMaterial }}">{{ $kodematerial->kodeMaterial }} - {{ $kodematerial->namaMaterial }}</option>
                      @endforeach
                    </select>
                    @error('kodeMaterial')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row g-3">
                      <div class="col-md-3 mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input class="form-control @error('jumlah') is-invalid @enderror" type="text" placeholder="Ketikkan jumlah..." name="jumlah" id="jumlah" value="{{ old('jumlah',$barangKeluar->jumlah) }}" onkeyup="this.value = this.value.toUpperCase()" required>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="keperluan" class="form-label">Kondisi</label>
                        <select class="form-control @error('kondisi') is-invalid @enderror" aria-label=".form-select-sm example" name="kondisi" id="kondisi" >
                            <option value="">- Pilih Salah Satu -</option>
                            @if (old('kondisi',$barangKeluar->kondisi)=='BARU')
                              <option value="BARU" selected>BARU</option>
                              <option value="BAGUS">BAGUS</option>
                            @elseif (old('kondisi',$barangKeluar->kondisi)=='BAGUS')
                              <option value="BARU" >BARU</option>
                              <option value="BAGUS" selected>BAGUS</option>
                            @else
                              <option value="BARU">BARU</option>
                              <option value="BAGUS">BAGUS</option>
                            @endif
                          </select>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="peruntukan" class="form-label">Peruntukan</label>
                        <input class="form-control @error('peruntukan') is-invalid @enderror" type="text" placeholder="Spare..." name="peruntukan" id="peruntukan" value="{{ old('peruntukan',$barangKeluar->peruntukan) }}" onkeyup="this.value = this.value.toUpperCase()" required>
                        @error('peruntukan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-3 mb-3">
                        <label for="keperluan" class="form-label">Keperluan</label>
                        <select class="form-control @error('keperluan') is-invalid @enderror" aria-label=".form-select-sm example" name="keperluan" id="keperluan">
                          <option value="">- Pilih Salah Satu -</option>
                          @if (old('keperluan',$barangKeluar->keperluan)=='PEMINJAMAN')
                              <option value="PEMINJAMAN" selected>PEMINJAMAN</option>
                              <option value="RETUR">RETUR</option>
                            @elseif (old('keperluan',$barangKeluar->keperluan)=='RETUR')
                              <option value="PEMINJAMAN" >PEMINJAMAN</option>
                              <option value="RETUR" selected>RETUR</option>
                            @else
                              <option value="PEMINJAMAN">PEMINJAMAN</option>
                              <option value="RETUR">RETUR</option>
                            @endif
                        </select>
                      </div>
                    <div class="col-md-3 mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input class="form-control @error('keterangan') is-invalid @enderror" type="text" placeholder="Ketikkan Keterangan..." name="keterangan" id="keterangan" value="{{ old('keterangan',$barangKeluar->keterangan) }}" onkeyup="this.value = this.value.toUpperCase()" required>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="tanggalKeluar" class="form-label">Tanggal Keluar</label>
                        <input class="form-control @error('tanggalKeluar') is-invalid @enderror" type="date" name="tanggalKeluar" id="tanggalKeluar" value="{{ old('tanggalKeluar',$barangKeluar->tanggalKeluar) }}" required>
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