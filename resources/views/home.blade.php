@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Inventaris Gudang PLN</h1>
    <p class="mb-4">Berisi beberapa laporan yang akan dimuat</p>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#printModal">
            Generate Report
        </button>
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
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Peruntukan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Lokasi Gudang</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Peruntukan</th>
                            <th>Keterangan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pen12</td>
                            <td>Test Pen</td>
                            <td>Rak A25</td>
                            <td>1504</td>
                            <td>Buah</td>
                            <td>Spare</td>
                            <td>UPT Surabaya Barat</td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection