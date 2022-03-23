<!--  -->
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

        <!-- TABEL ACARA -->
        <div class="row py-3"></div>

        <div class="card m-lg-5 border-0">
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
            <div class="card-header">Users List</div>
            <div class="card-body">
                @auth
                @if ( auth()->user()->role_id >= 2)
                <a class="btn btn-primary mb-3" href="/register">Register User +</a>
                @endif
                @endauth
                <table id="eventab" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Karyawana</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Unit/DKM</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_user as $ev=>$value)

                        <tr>
                            <td><?= $value->userid; ?></td>
                            <td><?= $value->name; ?></td>
                            <td><?= $value->email; ?></td>
                            <td><?= $value->unit_name; ?>-<?= $value->unit_area; ?></td>
                            <td><?= $value->role_name; ?></td>
                            <td>
                                <a id="<?= $ev; ?>" class="btn btn-outline-warning btn-sm" onclick="edit_function(this.id)">Edit</a>

                                <form action="/user/{{ $value->userid }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Want to delete this order?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </main>

    <div class="modal fade" id="edit_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" id="edit_user_form">
                        @method('put')
                        @csrf
                        <div class="card m-lg-1">
                            <div class="card-header">Form Edit User</div>

                            <!-- Small input -->
                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="mt-2">
                                    <div class="col-8 mt-2">

                                        <!-- Default input -->
                                        <!-- <label for="name">Full Name</label> -->
                                        <input type="checkbox" id="cgfullname" name="cgfullname" value="Yes">Ganti Full Name</input>
                                        <input type="text" name="name" class="form-control mb-2" id="name" placeholder="Full Name" required disabled>

                                    </div>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-8 mt-2">
                                    <!-- Default input -->
                                    <input type="checkbox" id="cgemail" name="cgemail" value="Yes">Ganti Alamat Email</input>
                                    <input type="email" name="email" class="form-control mb-2" id="email" placeholder="name@example.com" required disabled>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-8 mt-2">
                                    <input type="checkbox" id="cgpass" name="cgpass" value="Yes">Ganti Password</input>
                                    <input type="password" name="password" class="form-control mb-2" id="password" placeholder="Password" required disabled>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-8 mt-2">
                                    <input type="checkbox" id="cguserid" name="cguserid" value="Yes">Ganti FMI ID User</input>
                                    <input type="number" name="userid" class="form-control mb-2" id="userid" placeholder="FI User ID" required disabled>

                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-8 mt-2">
                                    <label class="mb-2 mt-3">User atau Admin ?</label>

                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="role_id" name="role_id" required>
                                        @foreach ($roles as $role)
                                        @if(old('edit_user_role_mdl',auth()->user()->role_id) == $role->id)
                                        <option value="<?= $role->id; ?>" selected><?= $role->role_name; ?></option>
                                        @else
                                        <option value="<?= $role->id; ?>"><?= $role->role_name; ?></option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-8 mt-2">
                                    <label class="mb-2 mt-3">Unit yang akan didaftarkan</label>

                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="unit_id" name="unit_id" required>
                                        @foreach ($units as $un)
                                        @if(old('edit_user_unit_mdl',auth()->user()->unit_id) == $un->id)
                                        <option value="<?= $un->id; ?>" selected><?= $un->unit_name; ?>-<?= $un->unit_area; ?></option>
                                        @else
                                        <option value="<?= $un->id; ?>"><?= $un->unit_name; ?>-<?= $un->unit_area; ?></option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <div class="col-8 mt-3 mb-2">
                                    <button type="submit" class="btn btn-primary" name="ubah_event" value="1">Save Edits</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah User</h5>
                </div>
                <div class="modal-body">
                    <form action="/user" method="POST" enctype="multipart/form-data" id="add_user">
                        @csrf
                        <div class="card m-lg-1">
                            <div class="card-header">Form Tambah User</div>

                            <!-- Small input -->
                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="mt-2">
                                    <div class="col-8 mt-2">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control mb-2" id="name" placeholder="Nama Lengkap" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-8 mt-2">
                                    <label for="email">Email FMI</label>
                                    <input type="email" name="email" class="form-control mb-2" id="email" placeholder="name@example.com" required>

                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <div class="col-8 mt-2">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control mb-2" id="password" placeholder="Password" required>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-8 mt-2">
                                    <label for="password">Freeport ID</label>
                                    <input type="userid" name="userid" class="form-control mb-2" id="userid" placeholder="FI User ID" required>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-8 mt-2">
                                    <label class="mb-2 mt-3">User atau Admin ?</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="role_id" name="role_id" required>
                                        @foreach ($roles as $role)
                                        <option value="<?= $role->id; ?>"><?= $role->role_name; ?></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <!-- Grid column -->
                                <div class="col-8 mt-2">
                                    <label class="mb-2 mt-3">Unit yang akan didaftarkan</label>

                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="unit_id" name="unit_id" required>
                                        @foreach ($units as $un)
                                        <option value="<?= $un->id; ?>"><?= $un->unit_name; ?>-<?= $un->unit_area; ?></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row m-lg-1">
                                <div class="col-8 mt-3 mb-2">
                                    <button type="submit" class="btn btn-primary" name="ubah_event" value="1">Tambah User</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

    <!-- untuk bagian edit user modal -->
    <script>
        function edit_function(clicked) {
            $('#edit_user').modal('show')
            // mengambil data event berdasarkan id event yg ada di tombol
            var arrayFromPHP = <?php echo json_encode($list_user); ?>;
            document.getElementById("name").value = arrayFromPHP[clicked]['name'];
            document.getElementById("email").value = arrayFromPHP[clicked]['email'];
            document.getElementById("password").value = arrayFromPHP[clicked]['password'];
            document.getElementById("userid").value = arrayFromPHP[clicked]['userid'];
            document.getElementById("role_id").value = arrayFromPHP[clicked]['role_id'];
            document.getElementById("unit_id").value = arrayFromPHP[clicked]['unit_id'];
            document.getElementById("edit_user_form").setAttribute("action", "/user/" + arrayFromPHP[clicked]['userid']);

        }
    </script>

    <!-- untuk bagian edit user check box modal -->
    <script>
        document.getElementById('cgfullname').onchange = function() {
            document.getElementById('name').disabled = !this.checked;
        };

        document.getElementById('cgemail').onchange = function() {
            document.getElementById('email').disabled = !this.checked;
        };

        document.getElementById('cgpass').onchange = function() {
            document.getElementById('password').disabled = !this.checked;
        };

        document.getElementById('cguserid').onchange = function() {
            document.getElementById('userid').disabled = !this.checked;
        };
    </script>

</body>

</html>