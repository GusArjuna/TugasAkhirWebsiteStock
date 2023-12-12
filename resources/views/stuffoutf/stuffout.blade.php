@extends('template.navbar')
@section('search')
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/stuffout">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2" name="search" value="{{ request('search') }}">
        <div class="input-group-append">
            <button class="btn btn-primary">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>    
@endsection
@section('bagan')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Barang Keluar</h1>
    <p class="mb-4">Berisi Laporan tentang Barang Keluar</p>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ url('/stuffout/datain') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Buat Laporan</a>
            <form action="/stuffout/printdel" method="post">
                @csrf
                <button type="submit" value="true" name="generate" class="btn btn-primary">
                    Generate Report
                </button>
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
            {{ $barangkeluars->links() }}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Kondisi</th>
                            <th>Peruntukan</th>
                            <th>Keperluan</th>
                            <th>Keterangan</th>
                            <th>Nama Peminjam</th>
                            <th>Divisi</th>
                            <th>Tanggal Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Kondisi</th>
                            <th>Peruntukan</th>
                            <th>Keperluan</th>
                            <th>Keterangan</th>
                            <th>Nama Peminjam</th>
                            <th>Divisi</th>
                            <th>Tanggal Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($barangkeluars as $barangkeluar)
                        <tr>
                            <td><input type="checkbox" name="print{{ $barangkeluar->id }}" id="print{{ $barangkeluar->id }}" value="{{ $barangkeluar->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>@foreach ($kodematerials as $kodematerial)
                                @if ($kodematerial->kodeMaterial == $barangkeluar->kodeMaterial)
                                    {{ $kodematerial->kodeMaterial }}
                                    @break
                                @endif
                            @endforeach
                            </td>
                            <td>@foreach ($kodematerials as $kodematerial)
                                @if ($kodematerial->kodeMaterial == $barangkeluar->kodeMaterial)
                                    {{ $kodematerial->namaMaterial }}
                                    @break
                                @endif
                            @endforeach
                            </td>
                            <td>{{ $barangkeluar->jumlah }}</td>
                            <td>@foreach ($kodematerials as $kodematerial)
                                @if ($kodematerial->kodeMaterial == $barangkeluar->kodeMaterial)
                                    {{ $kodematerial->satuan }}
                                    @break
                                @endif
                            @endforeach
                            </td>
                            <td>{{ $barangkeluar->kondisi }}</td>
                            <td>@foreach ($kodematerials as $kodematerial)
                                @if ($kodematerial->kodeMaterial == $barangkeluar->kodeMaterial)
                                    {{ $kodematerial->peruntukan }}
                                    @break
                                @endif
                            @endforeach</td>
                            <td>{{ $barangkeluar->keperluan }}</td>
                            <td>{{ $barangkeluar->keterangan }}</td>
                            <td>{{ $barangkeluar->peminjam }}</td>
                            <td>{{ $barangkeluar->divisi }}</td>
                            <td>{{ $barangkeluar->tanggalKeluar }}</td>
                            <td><a href="/stuffout/{{ $barangkeluar->id }}/editdata" class="btn btn-warning btn-circle">
                                <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" value="{{ $barangkeluar->id }}" name="delete" class="btn btn-danger btn-circle" onclick="return confirm('Yakin?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {{-- <form action="/stuffout/{{ $barangkeluar->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-circle" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </form>
                </table>
            </div>
        </div>
    </div>
@endsection