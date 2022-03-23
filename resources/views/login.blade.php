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
    <link rel="stylesheet" href="/login.css">

</head>

<body class="text-center">


    <main class="form-signin">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <form action="/login" method="POST">
            <!-- supaya tidak dibajak, pake csrf, dari lain web tak bisa masuk -->
            @csrf
            <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>

            <div class="form-floating mb-3">
                <label for="email">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">

                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>
            <div class="form-floating">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name='password' placeholder="Password">

            </div>

            <div class="checkbox mb-4">

            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            </class>

        </form>

        <small class="d-block mt-2"><a href="/">Home</a></small>
    </main>



</body>

</html>