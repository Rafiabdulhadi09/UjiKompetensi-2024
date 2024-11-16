<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cetak Nota</title>
        <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{url('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(90deg, #4e73df, #224abe);
            color: white;
        }
        .btn-custom {
            border-radius: 25px;
            padding: 10px 20px;
        }
        .btn-custom-primary {
            background-color: #4e73df;
            color: white;
        }
        .btn-custom-primary:hover {
            background-color: #224abe;
            color: white;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('component.NavbarAdmin')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-header gradient-bg">
                                    <h2 class="mb-0">Transaksi Berhasil</h2>
                                </div>
                                <div class="card-body">
                                    <p class="mb-4">Struk pembayaran telah berhasil dibuat. Anda dapat mencetak struk atau kembali ke halaman utama.</p>
                                    <a href="{{ route('cetak.struk', $id_transaksi->id) }}" class="btn btn-custom btn-custom-primary mb-2">
                                        <i class="fas fa-print"></i> Cetak Struk
                                    </a>
                                    <a href="{{route('admin')}}" class="btn btn-secondary btn-custom">
                                        <i class="fas fa-home"></i> Kembali
                                    </a>
                                </div>
                                <div class="card-footer text-muted">
                                    Toko Pakian Rafi &copy; 2024
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
    <script src="{{url('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{url('js/sb-admin-2.min.js')}}"></script>
    <script src="{{url('vendor/chart.js/Chart.min.js')}}"></script>
</body>

</html>
