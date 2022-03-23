<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YMM ASSET|LogIn</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/register.css">

</head>

<body>
    <div class="row justify-content-center">
        <div class="">
            <main class="form-registration">
                <h1 class="h3 mb-3 fw-normal">Registration Form</h1>
                <img class="mb-4" src="" alt="" width="72" height="57">
                <form action="/register" method="POST">
                    @csrf
                    <div class="form-floating">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror mb-2" id="name" placeholder="name" required value="{{ old('name') }}">

                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <label for="email">Email FMI</label>
                        <input type="email" name="email" class="form-control mb-2" id="email" placeholder="name@example.com" required value="{{ old('email') }}">

                    </div>
                    <div class="form-floating">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror mb-2" id="password" placeholder="Password" required>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <label for="password">Freeport ID</label>
                        <input type="userid" name="userid" class="form-control @error('userid') is-invalid @enderror mb-2" id="userid" placeholder="FI User ID" required>
                        @error('userid')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label class="mb-2 mt-3">Pilih untuk mendaftar</label>

                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="unit_id" name="unit_id" required>
                        @foreach ($unit as $un)
                        <option value="<?= $un[0]; ?>"><?= $un[1]; ?>-<?= $un[2]; ?></option>
                        @endforeach
                    </select>

                    <div class="checkbox mb-5">

                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>

                </form>
                <small class="d-block text-center mt-2">Already Registered?<a href="/login">Log In</a> </small>
            </main>

        </div>
    </div>



</body>

</html>