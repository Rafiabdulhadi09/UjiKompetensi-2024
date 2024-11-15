<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>
    <link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{url('vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css')}}">
    <link href="{{url('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">

    <link href="{{url('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template-->

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('component.NavbarKasir')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid m-2">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Transaksi Baru</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row p-2">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="get">
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label for="">Produk</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="hidden" name="transaksi_id" value="{{request()->segment(4)}}">
                                                <select name="barang_id" class="form-control">
                                                    @foreach ($produk as $item)
                                                        <option value="{{$item->id}}">{{$item->nm_barang}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="form-control mt-2 btn btn-warning">Tambah</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="{{route('kasir.create.transaksi')}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ isset($p_detail) ? $p_detail->nm_barang : ''}}" name="nm_barang">
                                        <input type="hidden" value="{{ isset($p_detail) ? $p_detail->harga : ''}}" name="harga_satuan">
                                        <input type="hidden" value="{{ request()->segment(4) }}" name="transaksi_id">
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label for="">Nama Produk</label>
                                            </div>
                                            <div class="col-md-8">
                                            <input type="text" disabled class="form-control" value="{{ isset($p_detail) ? $p_detail->nm_barang : '' }}" name="nm_barang">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label for="">Harga Satuan</label>
                                            </div>
                                            <div class="col-md-8">
                                            <input type="text" disabled class="form-control" value="{{ isset($p_detail) ? $p_detail->harga : '' }} "  name="harga_satuan">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label for="">Quantity</label>
                                            </div>
                                            <div class="col-md-8">
                                            <input type="number" class="form-control" name="qty" required>
                                            </div>
                                        </div>
                                    <div class="row mt-1">
                                        <div class="col-md-4">

                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-4">

                                        </div>
                                        <div class="col-md-8">
                                            <button type="submit" class="form-control btn btn-success">Tambah</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body"></div>
                                    <table class="table">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th>#</th>
                                        </tr>
                                        @foreach ($transaksi_detail->transaksidetail as $item)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <th>{{ $item->nm_barang}}</th>
                                            <th>{{$item->qty}}</th>
                                            <th>{{$item->subtotal}}</th>
                                            <th>
                                                <a href="/kasir/delete/transaksidetail?id={{$item->id}}"><i class="fas fa-times"></i></a>
                                            </tha>
                                        </tr>                                     
                                        @endforeach
                                    </table>
                                    <div class="m-3">
                                        <form action="" method="GET">
                                            <label for="">Masukan Jenis Pembayaran</label>
                                            <select name="pembayaran_id" class="form-control mb-3">
                                                @foreach ($pembayaran_id as $item)
                                                    <option value="{{$item->id}}">{{ $item->nm_pembayaran }}</option>                  
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                    <a href="{{route('kasir.nota', $item->id)}}" class="btn btn-primary"><i class="fas fa-check"></i>Selesai</a>
                                </div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form action=" " method="get">
                                            <input type="hidden" name="total_belanja" value="{{$total->total}}">
                                            <div class="form-group">
                                                <label for="">Total Belanja</label>
                                                <input type="number" value="{{ isset($total->total) ? $total->total : '' }}" disabled name="total_belanja" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Di bayarkan</label>
                                                <input type="number" name="dibayarkan" value="{{ request('dibayarkan') }}" class="form-control">
                                            </div>
        
                                            <button type="submit" class="btn btn-primary btn-block">Hitung</button>
                                        </form>
                                        <div class="form-group">
                                            <label for="">Uang Kembalian</label>
                                            <input type="number" disabled name="kembalian" value="{{$kembalian}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{url('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{url('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{url('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{url('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{url('js/demo/chart-pie-demo.js')}}"></script>

    <script src="{{url('https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js')}}"></script>
</body>

</html>