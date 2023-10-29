@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Barang Keluar</h1>
    <p class="mb-4">Berisi Laporan tentang Barang Keluar</p>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ url('/stuffout/editdata') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Buat Laporan</a>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#printModal">
            Generate Report
        </button>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Outbound Logistic</h6>
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
                            <th>Kondisi</th>
                            <th>Peruntukan</th>
                            <th>Keterangan</th>
                            <th>Tanggal Keluar</th>
                            <th>Aksi</th>
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
                            <th>Kondisi</th>
                            <th>Peruntukan</th>
                            <th>Keterangan</th>
                            <th>Tanggal Keluar</th>
                            <th>Aksi</th>
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
                            <td>2424</td>
                            <td>Spare</td>
                            <td>UPT Surabaya Barat</td>
                            <td>4 Januari 2023</td>
                            <td><a href="{{ url('/stuffout/editdata') }}" class="btn btn-warning btn-circle">
                                <i class="fas fa-edit"></i>
                                </a>
                                <form action="#" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Generate Report (PDF)</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">From</span>
                            <input type="date" class="form-control"name="tgldari">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Until</span>
                            <input type="date" class="form-control" name="tglsampai">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Generate</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection