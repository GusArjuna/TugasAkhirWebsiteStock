@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Kode Material</h1>
    </div>

        <!-- DataTales Example -->
    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Formulir Kode Material</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="row g-3">
                      <div class="col-md-3 mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input class="form-control @error('kode') is-invalid @enderror" type="text" placeholder="Ketikkan kode..." name="kode" id="kode">
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="nama material" class="form-label">Nama Material</label>
                        <input class="form-control @error('nama material') is-invalid @enderror" type="text" placeholder="Ketikkan nama material..." name="nama material" id="nama material">
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input class="form-control @error('satuan') is-invalid @enderror" type="text" placeholder="Buah / Biji" name="satuan" id="satuan">
                        @error('satuan')
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