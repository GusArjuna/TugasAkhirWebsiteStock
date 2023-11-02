@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Barang Keluar</h1>
    </div>

        <!-- DataTales Example -->
    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Barang Keluar</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="/cobacoba">
                @csrf
                <div class="row g-3">
                  <div class="col-md-6 mb-3">
                    <label for="kodeMaterial" class="form-label">Kode - Nama Barang</label>
                    <input type="checkbox" name="coba" id="coba" value="kiriman">
                    <input type="checkbox" name="coba1" id="coba1" value="kiriman1">

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