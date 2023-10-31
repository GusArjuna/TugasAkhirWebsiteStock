@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Barang Masuk</h1>
    <p class="mb-4">Berisi Laporan Barang Masuk</p>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ url('/stuffin/datain') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Buat Laporan</a>
            <a type="button" class="btn btn-primary" href="/stuffin/print">
                Generate Report
            </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inbound Logistic</h6>
        </div>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Kondisi</th>
                            <th>Peruntukan</th>
                            <th>Keterangan</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Kondisi</th>
                            <th>Peruntukan</th>
                            <th>Keterangan</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($barangmasuks as $barangmasuk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>@foreach ($kodematerials as $kodematerial)
                                {{ 
                                    ($kodematerial->kodeMaterial==$barangmasuk->kodeMaterial)? $kodematerial->kodeMaterial :""
                                }}
                                @endforeach
                            </td>
                            <td>@foreach ($kodematerials as $kodematerial)
                                {{ 
                                    ($kodematerial->kodeMaterial==$barangmasuk->kodeMaterial)? $kodematerial->namaMaterial :""
                                }}
                                @endforeach
                            </td>
                            <td>{{ $barangmasuk->jumlah }}</td>
                            <td>@foreach ($kodematerials as $kodematerial)
                                {{ 
                                    ($kodematerial->kodeMaterial==$barangmasuk->kodeMaterial)? $kodematerial->satuan :""
                                }}
                                @endforeach
                            </td>
                            <td>{{ $barangmasuk->kondisi }}</td>
                            <td>{{ $barangmasuk->peruntukan }}</td>
                            <td>{{ $barangmasuk->keterangan }}</td>
                            <td>{{ $barangmasuk->tanggalMasuk }}</td>
                            <td><a href="/stuffin/{{ $barangmasuk->id }}/editdata" class="btn btn-warning btn-circle">
                                <i class="fas fa-edit"></i>
                                </a>
                                <form action="/stuffin/{{ $barangmasuk->id }}" method="POST" class="d-inline" >
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-circle" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection