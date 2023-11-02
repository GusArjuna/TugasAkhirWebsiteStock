@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ketersediaan Barang</h1>
    <p class="mb-4">Berisi Laporan Jumlah Barang pada kantor</p>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <form action="/printstok" method="post">
            @csrf
            <button type="submit" value="true" name="generate" class="btn btn-primary">
                Generate Report
            </button>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ketersediaan Barang</h6>
        </div>
        <div class="card-body">
            {{ $kodematerials->links() }}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Frekuensi Penggunaan</th>
                            <th>Peruntukan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Frekuensi Penggunaan</th>
                            <th>Peruntukan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($kodematerials as $kodematerial)
                        <tr>
                            <td> <input type="checkbox" name="print{{ $kodematerial->id }}" id="print{{ $kodematerial->id }}" value="{{ $kodematerial->id }}"> </td>
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $kodematerial->kodeMaterial}} </td>
                            <td> {{ $kodematerial->namaMaterial}} </td>
                            <td> {{ $kodematerial->stok}} </td>
                            <td> {{ $kodematerial->satuan}} </td>
                            <td> {{ $kodematerial->frekuensi}} </td>
                            <td> {{ $kodematerial->peruntukan}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
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