@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kode Material</h1>
    </div>

        <!-- DataTales Example -->
    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Kode Material</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="/code/datain">
                @csrf
                <div class="row g-3">
                      <div class="col-md-3 mb-3">
                        <label for="kodeMaterial" class="form-label">Kode</label>
                        <input class="form-control @error('kodeMaterial') is-invalid @enderror" type="text" placeholder="Ketikkan kode..." name="kodeMaterial" id="kodeMaterial" value="{{ old('kodeMaterial') }}" onkeyup="this.value = this.value.toUpperCase()" required autofocus>
                      </div>
                      @error('kodeMaterial')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      <div class="col-md-3 mb-3">
                        <label for="namaMaterial" class="form-label">Nama Material</label>
                        <input class="form-control @error('namaMaterial') is-invalid @enderror" type="text" placeholder="Ketikkan nama material..." name="namaMaterial" id="namaMaterial" value="{{ old('namaMaterial') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                      </div>
                      @error('namaMaterial')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      <div class="col-md-3 mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input class="form-control @error('satuan') is-invalid @enderror" type="text" placeholder="Buah / Biji" name="satuan" id="satuan" value="{{ old('satuan') }}" onkeyup="this.value = this.value.toUpperCase()" required>
                        @error('satuan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                </div>
                <div class="row g-3">
                      <div class="col-md-3 mb-3">
                        <label for="peruntukan" class="form-label">Peruntukan</label>
                        <input class="form-control @error('peruntukan') is-invalid @enderror" type="text" placeholder="Ketikkan kode..." name="peruntukan" id="peruntukan" value="{{ old('peruntukan') }}" onkeyup="this.value = this.value.toUpperCase()" required autofocus>
                      </div>
                      @error('peruntukan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                </div>
                <button class="btn btn-success btn-icon-split" type="submit">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Submit</span>
                </button>
              </form>  
        </div>
    </div>
@endsection