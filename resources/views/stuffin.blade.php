@extends('template.navbar')
@section('judul', 'Barang Masuk')
@section('bagan')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Barang Masuk</h1>
    <p class="mb-4">Berisi Laporan Barang Masuk</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inbound Logistic</h6>
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