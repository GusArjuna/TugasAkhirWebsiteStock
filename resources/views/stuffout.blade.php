@extends('template.navbar')
@section('judul', 'Barang Keluar')
@section('bagan')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Barang Keluar</h1>
    <p class="mb-4">Berisi Laporan tentang Barang Keluar</p>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
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
                            <th>Nama Laporan</th>
                            <th>Jumlah Laporan</th>
                            <th>Jenis Laporan</th>
                            <th>Tingkat Urgensi</th>
                            <th>Tempat Penyimpanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Laporan</th>
                            <th>Jumlah Laporan</th>
                            <th>Jenis Laporan</th>
                            <th>Tingkat Urgensi</th>
                            <th>Tempat Penyimpanan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
                        <tr>
                            <td>Proposal Keuangan</td>
                            <td>5</td>
                            <td>Proposal</td>
                            <td>1</td>
                            <td>Lemari a25</td>
                            <td><a href="#" class="btn btn-warning btn-circle">
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
@endsection