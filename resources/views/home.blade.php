@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Inventaris Gudang PLN</h1>
    <p class="mb-4">Berisi beberapa laporan yang akan dimuat</p>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a type="button" class="btn btn-primary" href="/print">
            Generate Report
        </a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rak Inventaris</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Lokasi Gudang</th>
                            <th>Satuan</th>
                            <th>Peruntukan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Lokasi Gudang</th>
                            <th>Satuan</th>
                            <th>Peruntukan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($kodematerials as $kodematerial)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $kodematerial->kodeMaterial}} </td>
                            <td> {{ $kodematerial->namaMaterial}} </td>
                            <td> Rak ... </td>
                            <td> {{ $kodematerial->satuan}} </td>
                            <td> {{ $kodematerial->peruntukan}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection