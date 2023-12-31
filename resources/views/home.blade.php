@extends('template.navbar')
@section('search')
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/">
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
    <h1 class="h3 mb-2 text-gray-800">Inventaris Gudang PLN</h1>
    <p class="mb-4">Berisi beberapa laporan yang akan dimuat</p>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <form action="/updatefsn" method="post">
            @csrf
            <div class="input-group mb-3">
                <label class="input-group-text rounded-left" style="border-radius: 0" for="inputGroupSelect01">Tahun</label>
                <select class="form-select" name="tahun">
                    <option value="">Pilih Tahun</option>
                    @php
                        $start_year = date("Y") - 100; // Tahun mulai
                        $end_year = date("Y") + 100; // Tahun akhir
                        $tahun = $fsns->first()->tahun??'';
                    @endphp
                    @for ($i = $end_year; $i >= $start_year; $i--)
                        @if ($i==$tahun)
                            <option value={{ $i }} selected>{{ $i }}</option>
                        @else
                            <option value={{ $i }}>{{ $i }}</option>
                        @endif
                    @endfor
                </select>
              </div>
            
            
            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                <i class="fas fa-undo fa-sm text-white-50"></i> Update Rak</a>
            </button>
        </form>
            <form action="/printdashboard" method="post">
                @csrf
                <button type="submit" value="true" name="generate" class="btn btn-primary">
                    Generate Report
                </button>
                <input type="hidden" name="search" value="{{ request('search') }}">
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rak Inventaris</h6>
        </div>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card-body">
            {{ $fsns->links() }}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Lokasi Gudang</th>
                            <th>Satuan</th>
                            <th>Peruntukan</th>
                            <th>Nilai TOR</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode Katalog</th>
                            <th>Nama Material</th>
                            <th>Lokasi Gudang</th>
                            <th>Satuan</th>
                            <th>Peruntukan</th>
                            <th>Nilai TOR</th>
                            <th>Kategori</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($fsns as $fsn)
                        <tr>
                            <td> <input type="checkbox" name="print{{ $fsn->id }}" id="print{{ $fsn->id }}" value="{{ $fsn->id }}"> </td>
                            <td> {{ $loop->iteration }} </td>
                            <td> 
                                @foreach ($kodematerials as $kodematerial)
                                    @if ($kodematerial->kodeMaterial == $fsn->kodeMaterial)
                                        {{ $kodematerial->kodeMaterial }}
                                        @break
                                    @endif
                                @endforeach
                             </td>
                            <td> @foreach ($kodematerials as $kodematerial)
                                @if ($kodematerial->kodeMaterial == $fsn->kodeMaterial)
                                    {{ $kodematerial->namaMaterial }}
                                    @break
                                @endif
                            @endforeach </td>
                            <td> {{ $fsn->lokasi}} </td>
                            <td> @foreach ($kodematerials as $kodematerial)
                                @if ($kodematerial->kodeMaterial == $fsn->kodeMaterial)
                                    {{ $kodematerial->satuan }}
                                    @break
                                @endif
                            @endforeach </td>
                            <td> @foreach ($kodematerials as $kodematerial)
                                @if ($kodematerial->kodeMaterial == $fsn->kodeMaterial)
                                    {{ $kodematerial->peruntukan }}
                                    @break
                                @endif
                            @endforeach </td>
                            <td> {{ $fsn->tor}} </td>
                            <td> {{ $fsn->kategori}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>
@endsection