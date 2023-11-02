@extends('template.navbar')
@section('search')
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/kodematerial/search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2" name="search">
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
    <h1 class="h3 mb-2 text-gray-800">Kode Material</h1>
    <p class="mb-4">Berisi Kode Material Yang Ada Pada Inventaris</p>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ url('/code/datain') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Material</a>
            <form action="/code/printdel" method="post">
                @csrf
                <button type="submit" value="true" name="generate" class="btn btn-primary">
                    Generate Report
                </button>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kode Matrial</h6>
        </div>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
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
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($kodematerials as $kodematerial)
                        <tr>
                            <td><input type="checkbox"  name="print{{ $kodematerial->id }}" id="print{{ $kodematerial->id }}" value="{{ $kodematerial->id }}"></td> 
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kodematerial->kodeMaterial }}</td>
                            <td>{{ $kodematerial->namaMaterial }}</td>
                            <td>{{ $kodematerial->satuan }}</td>
                            <td><a href="/code/{{ $kodematerial->id }}/editdata" class="btn btn-warning btn-circle">
                                <i class="fas fa-edit"></i>
                                </a>
                                {{-- <form action="/code/{{ $kodematerial->id }}" method="POST" class="d-inline"> --}}
                                    {{-- @method('delete') --}}
                                    {{-- @csrf --}}
                                    <button type="submit" value="{{ $kodematerial->id }}" name="delete" class="btn btn-danger btn-circle" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                {{-- </form> --}}
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