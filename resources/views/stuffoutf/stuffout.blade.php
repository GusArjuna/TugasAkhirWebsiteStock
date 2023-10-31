@extends('template.navbar')
@section('bagan')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Barang Keluar</h1>
    <p class="mb-4">Berisi Laporan tentang Barang Keluar</p>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ url('/stuffout/datain') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Buat Laporan</a>
            <a type="button" class="btn btn-primary" href="/stuffout/print">
                Generate Report
            </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Outbound Logistic</h6>
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
                            <th>Keperluan</th>
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
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Kondisi</th>
                            <th>Peruntukan</th>
                            <th>Keperluan</th>
                            <th>Keterangan</th>
                            <th>Tanggal Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($barangkeluars as $barangkeluar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>@foreach ($kodematerials as $kodematerial)
                                {{ 
                                    ($kodematerial->kodeMaterial==$barangkeluar->kodeMaterial)? $kodematerial->kodeMaterial :""
                                }}
                                @endforeach
                            </td>
                            <td>@foreach ($kodematerials as $kodematerial)
                                {{ 
                                    ($kodematerial->kodeMaterial==$barangkeluar->kodeMaterial)? $kodematerial->namaMaterial :""
                                }}
                                @endforeach
                            </td>
                            <td>{{ $barangkeluar->jumlah }}</td>
                            <td>@foreach ($kodematerials as $kodematerial)
                                {{ 
                                    ($kodematerial->kodeMaterial==$barangkeluar->kodeMaterial)? $kodematerial->satuan :""
                                }}
                                @endforeach
                            </td>
                            <td>{{ $barangkeluar->kondisi }}</td>
                            <td>{{ $barangkeluar->peruntukan }}</td>
                            <td>{{ $barangkeluar->keperluan }}</td>
                            <td>{{ $barangkeluar->keterangan }}</td>
                            <td>{{ $barangkeluar->tanggalKeluar }}</td>
                            <td><a href="/stuffout/{{ $barangkeluar->id }}/editdata" class="btn btn-warning btn-circle">
                                <i class="fas fa-edit"></i>
                                </a>
                                <form action="/stuffout/{{ $barangkeluar->id }}" method="POST" class="d-inline">
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