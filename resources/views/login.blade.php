<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                
              <form action="{{ route('login')}}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>       
                @endif
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="text" value="{{ old('username') }}" name="username" id="form1Example13" class="form-control form-control-lg" />
                  <label class="form-label" for="form1Example13">Masukan Username</label>
                </div>
      
                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" value="{{ old('password') }}"  name="password" id="form1Example23" class="form-control form-control-lg" />
                  <label class="form-label" for="form1Example23">Password</label>
                </div>
      
                <!-- Submit button -->
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Kirim</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </section>
</body>
</html>