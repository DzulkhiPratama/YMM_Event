<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <link rel="icon" type="image/png" href="/assets/img/imgymm.png">
    <title>YMM PTFI Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="/assets/distA/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" type="text/css">
    <link href="/carousel_modal.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <link rel="stylesheet" href="/jquery.datetimepicker.min.css">

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <nav class="navbar navbar-light bg-light">
                    <a class="navbar-brand" href="#">
                        <img src="/assets/img/imgymm.png" width="120" height="50" class="d-inline-block align-top" alt="">
                    </a>
                </nav>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Unit Kegiatan</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                @foreach($list_unit as $unit)
                                <li><a class="dropdown-item" href="/event/<?= $unit['unit_code_str']; ?>"><?= $unit['unit_name']; ?></a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">DKM</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                @foreach($list_dkm as $dkm)
                                <li><a class="dropdown-item" href="/event/<?= $dkm->unit_code_str; ?>"><?= $dkm->unit_name; ?></a></li>
                                @endforeach
                            </ul>
                        </li>
                        @auth
                        @if(auth()->user()->role_id==2)
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/user">User management</a>
                        </li>
                        @endif
                        @endauth

                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false"> {{ auth()->user()->name }}</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                <li class="nav-item dropdown">
                                    <FORM method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i>Log Out</i></button>
                                    </FORM>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Log in</a>
                        </li>
                        @endauth
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <main>

        <!-- Nama unit dan desc nya -->
        <section class="py-5 text-center container">
            <div class="row py-lg-3"></div>
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>

                    @elseif(session()->has('danger'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('danger') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <h1 class="fw-light"><?= $event_empty->unit_name; ?></h1>
                    <p class="lead text-muted"><?= $event_empty->unit_desc; ?></p>

                    <p>
                        @auth
                        @if(auth()->user()->unit_id == $event_empty->unit_id)
                        <a href="#add_event" class="btn btn-primary my-2" onclick="add_function()">Tambah Acara</a>
                        @endif
                        @endauth
                        <a href="#" class="btn btn-secondary my-2">Social Media</a>
                    </p>
                </div>
            </div>
        </section>

        <hr class="featurette-divider m-lg-5">

        <!-- recently event -->
        <div class="album bg-light">
            <div class="container">

                @if($event_count == 0)
                <p style="text-align: center;">- BELUM ADA EVENT -</p>
                @else
                <section class="text-center container mt-2">
                    <h1 class="fw-light mb-2">Recently Event</h1>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-5">
                        <!-- TOP NEWEST 3 EVENT -->
                        @foreach ($event_unit_upper_three as $upthree=>$value)
                        <div class="col">
                            <div class="card shadow-sm mb-3">
                                <?php
                                $arr = $value->image;
                                $imgtr = explode("|", $arr);
                                ?>
                                <!-- yg jadi wallpaper image pertama dari implode field image dari tabel -->
                                <img src="/<?= $imgtr[0]; ?>" height="225">
                                <div class="card-body">
                                    <h5><?= $value->event_name; ?></h5>
                                    <p class="card-text"><?= $value->event_desc; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" id=<?= $upthree; ?> class="btn btn-sm btn-outline-secondary" onclick="detail_function(this.id)">View</button>
                                        </div>
                                        <small class="text-muted"><?= date('d F Y', strtotime($value->start_at)); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif

            </div>
        </div>

        <hr class="featurette-divider m-lg-5">

        <!-- tulisan LIST ACARA UNIT -->
        <section class="text-center container mt-2">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    @if($event_count == 0)
                    <h1 class="fw-light">List Acara <?= $event_empty->unit_name; ?></h1>
                    @else
                    <h1 class="fw-light">List Acara <?= $event[0]->unit_name; ?></h1>
                    @endif
                </div>
            </div>
        </section>

        <!-- TABEL ACARA -->
        <div class="card m-lg-5 border-0">
            <table id="eventab" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Tgl Pelaksanaan</th>
                        <th>Acara</th>
                        <th>Diregistrasi Oleh</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($event as $ev=>$value)

                    <tr>
                        <td><?= $value->start_at; ?></td>
                        <td><?= $value->event_name; ?></td>
                        <td><?= $value->name; ?></td>
                        <td><?= $value->unit_name; ?>-<?= $value->unit_area; ?></td>
                        <td>
                            <a id="<?= $ev; ?>" class="btn btn-outline-info btn-sm" onclick="detail_function(this.id)">Info</a>
                            @auth
                            @if(auth()->user()->unit_id == $event_empty->unit_id)
                            <a id="<?= $ev; ?>" class="btn btn-outline-warning btn-sm" onclick="edit_function(this.id)">Edit</a>

                            <form method="post" class="d-inline" id="delete_event_form">
                                @method('delete')
                                @csrf
                                <button id="<?= $ev; ?>" class="btn btn-outline-danger btn-sm" onclick="delete_function(this.id)">Delete</button>
                            </form>
                            @endif
                            @endauth
                        </td>
                    </tr>

                    @endforeach
                </tbody>

            </table>
        </div>

        <hr class="featurette-divider m-lg-5">

        <!-- MODAL -->

        <div class="modal fade" id="event_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">YMM Event Page</h5>
                    </div>
                    <div class="modal-body">
                        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" class="m-lg-3">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img id="carousel_img_detail_a">
                                </div>
                                <div class="carousel-item">
                                    <img id="carousel_img_detail_b">
                                </div>
                                <div class="carousel-item">
                                    <img id="carousel_img_detail_c">
                                </div>
                                <!-- // dapatkan array dari yg diklik dulu, lempar dari JS ke dalam tag modal -->
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-header">Detail Informasi Acara</div>
                            <!-- Small input -->
                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-10 mt-2">
                                    <label>Nama Acara</label>
                                    <input type="text" class="form-control" placeholder="Nama Acara" id="event_name_mdl" name="event_name_mdl" disabled>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-10 mt-2">
                                    <label>Deskripsi Acara</label>
                                    <textarea class="form-control" placeholder="Deskripsi Acara" id="event_desc_mdl" name="event_desc_mdl" rows="3" disabled></textarea>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-5 mt-2">

                                    <label>Acara Mulai</label>
                                    <input id="start_at_mdl" type="text" class="form-control" placeholder="Acara Mulai" name="start_at_mdl" disabled>

                                </div>

                                <div class="col-5 mt-2">
                                    <label>Acara Selesai</label>
                                    <input id="end_at_mdl" type="text" class="form-control" placeholder="Acara Selesai" name="end_at_mdl" disabled>

                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-6 mt-2">
                                    <label>Dana Acara (IDR)</label>
                                    <input type="text" class="form-control" placeholder="Price of Asset" id="budget_idr_str_mdl" name="budget_idr_str_mdl" disabled>
                                </div>

                                <div class="col-4 mt-4">
                                    <a class="btn btn-primary btn-sm" id="pdf_download_mdl">Download PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Acara</h5>
                    </div>
                    <div class="modal-body">
                        <form action="/event" method="POST" enctype="multipart/form-data" id="add_event">
                            @csrf
                            <div class="card m-lg-1">
                                <div class="card-header">Form Tambah Acara</div>

                                <!-- Small input -->
                                <div class="row m-lg-1">
                                    <!-- Grid column -->
                                    <div class="mt-2">
                                        <label>Nama Acara</label>
                                        <input type="text" class="form-control @error('event_name') is-invalid @enderror" placeholder="Nama Acara" id="event_name" name="event_name" required value="{{ old('event_name') }}" maxlength="30">
                                        @error('event_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <!-- Grid column -->
                                    <div class="mt-2">
                                        <label>Deskripsi Acara</label>
                                        <textarea class="form-control @error('event_desc') is-invalid @enderror" placeholder="Deskripsi Acara" id="event_desc" name="event_desc" rows="3" required value="{{ old('event_desc') }}" maxlength="150"></textarea>
                                        @error('event_desc')
                                        <div class=" invalid-feedback">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <!-- Grid column -->
                                    <div class="col-5 mt-2">

                                        <label>Acara Mulai</label>
                                        <input id="start_at" type="text" class="form-control @error('start_at') is-invalid @enderror" placeholder="Acara Mulai" name="start_at" required value="{{ old('start_at') }}">
                                        @error('start_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-5 mt-2">
                                        <label>Acara Selesai</label>
                                        <input id="end_at" type="text" class="form-control @error('end_at') is-invalid @enderror" placeholder="Acara Selesai" name="end_at" required value="{{ old('end_at') }}">
                                        @error('end_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <!-- Grid column -->
                                    <div class="col-8 mt-2">
                                        <label>Dana Acara (IDR)</label>
                                        <input type="text" class="form-control" placeholder="Price of Asset" id="budget_idr_str" name="budget_idr_str" value="" required>
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <div class="mt-2">
                                        <label for="">Upload PDF Acara</label>
                                        <input type="file" name="pdf" id="pdf" class="form-control @error('pdf') is-invalid @enderror" required>
                                        @error('pdf')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <div class="mt-2">
                                        <label for="">Upload Dokum Acara (3 Gambar)</label>
                                        <input type="file" name="img[]" id="img" class="form-control @error('img') is-invalid @enderror" required multiple>
                                        @error('img')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <div class="col-8 mt-3 mb-2">
                                        <button type="submit" class="btn btn-primary" name="tambah_event" value="1">Submit</button>
                                    </div>
                                </div>

                            </div>

                            <input type="number" class="form-control" placeholder="Your Asset Price" id="budget" name="budget" hidden>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit_event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Acara</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" id="edit_event_form">
                            @method('put')
                            @csrf
                            <div class="card m-lg-1">
                                <div class="card-header">Form Edit Acara</div>

                                <!-- Small input -->
                                <div class="row m-lg-1">
                                    <!-- Grid column -->
                                    <div class="mt-2">
                                        <label>Nama Acara</label>
                                        <input type="text" class="form-control" placeholder="Nama Acara" id="edit_event_name_mdl" name="edit_event_name_mdl" required value="{{ old('edit_event_name_mdl') }}" maxlength="30">
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <!-- Grid column -->
                                    <div class="mt-2">
                                        <label>Deskripsi Acara</label>
                                        <textarea class="form-control" placeholder="Deskripsi Acara" id="edit_event_desc_mdl" name="edit_event_desc_mdl" rows="3" required value="{{ old('edit_event_desc_mdl') }}" maxlength="150"></textarea>

                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <!-- Grid column -->
                                    <div class="col-5 mt-2">
                                        <label>Acara Mulai</label>
                                        <input id="edit_start_at_mdl" type="text" class="form-control" placeholder="Acara Mulai" name="edit_start_at_mdl" required value="{{ old('edit_start_at_mdl') }}">
                                    </div>

                                    <div class="col-5 mt-2">
                                        <label>Acara Selesai</label>
                                        <input id="edit_end_at_mdl" type="text" class="form-control" placeholder="Acara Selesai" name="edit_end_at_mdl" required value="{{ old('edit_end_at_mdl') }}">
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <!-- Grid column -->
                                    <div class="col-8 mt-2">
                                        <label>Dana Acara (IDR)</label>
                                        <input type="text" class="form-control" placeholder="Price of Asset" id="edit_budget_idr_str_mdl" name="edit_budget_idr_str_mdl" required>
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <div class="mt-2">
                                        <label for="">Upload PDF Acara</label>
                                        <input type="file" name="pdf_mdl" id="pdf_mdl" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <div class="mt-2">
                                        <label for="">Upload Dokum Acara (3 Gambar)</label>
                                        <input type="file" name="imgmdl[]" id="imgmdl" class="form-control" required multiple>
                                    </div>
                                </div>

                                <div class="row m-lg-1">
                                    <div class="col-8 mt-3 mb-2">
                                        <button type="submit" class="btn btn-primary" name="ubah_event" value="1">Save Edits</button>
                                    </div>
                                </div>

                            </div>

                            <input type="number" class="form-control" placeholder="Your Asset Price" id="edit_budget_mdl" name="edit_budget_mdl" hidden>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2022, YMM PTFI. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

    <script>
        $(document).ready(function() {
            $('#eventab').DataTable();
        });
    </script>

    <script src="/assets/distA/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <!-- <script src="/jquery.js"></script> -->
    <script src="/jquery.datetimepicker.full.min.js"></script>

    <!-- untuk bagian date time picker -->
    <script>
        $("#start_at").datetimepicker();
        $("#end_at").datetimepicker();

        $("#edit_start_at_mdl").datetimepicker();
        $("#edit_end_at_mdl").datetimepicker();
    </script>

    <!-- untuk bagian koma ribuan pada add event modal -->
    <script type="text/javascript">
        var rupiah = document.getElementById('budget_idr_str');
        var rupiax = document.getElementById('budget');

        rupiah.addEventListener('change', function(e) {
            originalText = rupiah.value;
            removedDotText = originalText.split(".").join("");
            removedSpacesText = removedDotText.split(" ").join("");
            removedRPText = removedSpacesText.replace('Rp', '');
            var harganya = parseFloat(removedRPText)
            rupiax.value = harganya;
        })

        rupiah.addEventListener('keyup', function(e) {
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        })

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>

    <!-- untuk bagian add event modal -->
    <script>
        function add_function() {
            $('#add_event').modal('show')
        }
    </script>

    <!-- untuk bagian show detail modal -->
    <script>
        function detail_function(clicked) {
            $('#event_detail').modal('show')
            // mengambil data event berdasarkan id event yg ada di tombol
            var arrayFromPHP = <?php echo json_encode($event); ?>;
            document.getElementById("event_name_mdl").value = arrayFromPHP[clicked]['event_name'];
            document.getElementById("event_desc_mdl").value = arrayFromPHP[clicked]['event_desc'];
            document.getElementById("start_at_mdl").value = arrayFromPHP[clicked]['start_at'];
            document.getElementById("end_at_mdl").value = arrayFromPHP[clicked]['end_at'];

            document.getElementById("pdf_download_mdl").setAttribute("href", "/event/" + arrayFromPHP[clicked]['event_id'] + "/download");

            var myStr = arrayFromPHP[clicked]['image'];
            var strArray = myStr.split("|");

            document.getElementById("carousel_img_detail_a").src = "/" + strArray[0]
            document.getElementById("carousel_img_detail_b").src = "/" + strArray[1]
            document.getElementById("carousel_img_detail_c").src = "/" + strArray[2]

            var arrayFromPHP = <?php echo json_encode($event); ?>;
            asset_price = arrayFromPHP[clicked]['budget'];
            // console.log(arrayFromPHP[0]['budget'])
            var asset_prices = document.getElementById('budget_idr_str_mdl');
            asset_prices.value = formatRupiah(asset_price, 'Rp. ');
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>

    <!-- untuk bagian edit detail modal -->
    <script>
        function edit_function(clicked) {
            $('#edit_event').modal('show')
            // mengambil data event berdasarkan id event yg ada di tombol
            var arrayFromPHP = <?php echo json_encode($event); ?>;
            document.getElementById("edit_event_name_mdl").value = arrayFromPHP[clicked]['event_name'];
            document.getElementById("edit_event_desc_mdl").value = arrayFromPHP[clicked]['event_desc'];
            document.getElementById("edit_start_at_mdl").value = arrayFromPHP[clicked]['start_at'];
            document.getElementById("edit_end_at_mdl").value = arrayFromPHP[clicked]['end_at'];

            asset_price = arrayFromPHP[clicked]['budget'];
            // console.log(arrayFromPHP[0]['budget'])
            var asset_prices = document.getElementById('edit_budget_idr_str_mdl');
            asset_prices.value = formatRupiah(asset_price, 'Rp. ');

            var rupiah = document.getElementById('edit_budget_idr_str_mdl');
            var rupiax = document.getElementById('edit_budget_mdl');

            document.getElementById("edit_event_form").setAttribute("action", "/event/" + arrayFromPHP[clicked]['event_id']);

            rupiah.addEventListener('change', function(e) {
                originalText = rupiah.value;
                removedDotText = originalText.split(".").join("");
                removedSpacesText = removedDotText.split(" ").join("");
                removedRPText = removedSpacesText.replace('Rp', '');
                var harganya = parseFloat(removedRPText)
                rupiax.value = harganya;
            })

            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value, 'Rp. ');
            })

            function formatRupiah(angka, prefix) {
                var number_string = angka.toString().replace(/[^,\d]/g, ''),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }


        }
    </script>

    <!-- Menghapus Event -->
    <script>
        function delete_function(clicked) {

            // mengambil data event berdasarkan id event yg ada di tombol
            var r = confirm("Apakah Anda yakin menghapus Event ini ?");
            var arrayFromPHP = <?php echo json_encode($event); ?>;
            if (r == true) {
                document.getElementById("delete_event_form").setAttribute("action", "/event/" + arrayFromPHP[clicked]['event_id']);
            } else {
                // kalo terakhir ID ada 'a' , maka akan jadi tanda untuk cancel hapus
                document.getElementById("delete_event_form").setAttribute("action", "/event/" + arrayFromPHP[clicked]['event_id'] + 'a');
            }
        }
    </script>

</body>

</html>