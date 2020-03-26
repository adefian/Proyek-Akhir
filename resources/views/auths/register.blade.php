<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; TS</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/stisla/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/stisla/css/components.css')}}">
</head>
<style>
  body {
    background:linear-gradient(10deg, #6777ef, #fff);
  }
</style>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-8 col-md-8 col-lg-6 col-xl-6">
            <!-- <div class="login-brand">
              <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div> -->

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
              <form method="POST" action="postlogin" class="needs-validation" novalidate="">
                  {{csrf_field()}}

                <div class="row">
                 <div class="col-6">
                  <div class="form-group">
                    <div class="d-block">
                    	<label for="nama" class="control-label">Nama</label>
                    </div>
                    <input id="nama" type="nama" class="form-control" name="nama" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your name
                    </div>
                  </div>
                 </div> 

                 <div class="col-6">
                 <div class="form-group">
                    <div class="d-block">
                    	<label for="username" class="control-label">Username</label>
                    </div>
                    <input id="username" type="username" class="form-control" name="username" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your username
                    </div>
                  </div>
                 </div> 
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                
                <div class="row">
                 <div class="col-6">
                  <div class="form-group">
                    <div class="d-block">
                    	<label for="alamat" class="control-label">Alamat</label>
                    </div>
                    <textarea id="alamat" type="alamat" class="form-control" name="alamat" tabindex="2" required></textarea>
                    <div class="invalid-feedback">
                      please fill in your alamat
                    </div>
                  </div>
                 </div> 

                 <div class="col-6">
                 <div class="form-group">
                    <div class="d-block">
                    	<label for="nohp" class="control-label">No Hp</label>
                    </div>
                    <input id="nohp" type="nohp" class="form-control" name="nohp" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your no hp
                    </div>
                  </div>
                 </div> 
                </div>

                <div class="row">
                  <div class="form-group col-6">
                    <div class="d-block">
                    	<label for="jeniskelamin" class="control-label">Gender</label>
                    </div>
                    <input id="jeniskelamin" type="jeniskelamin" class="form-control" name="jeniskelamin" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your gender
                    </div>
                  </div>

                 <div class="form-group col-6">
                    <div class="d-block">
                        <label for="wilayah" class="control-label">Wilayah</label>
                        <select name="wilayah" type="text" class="form-control">
                            <option selected disabled>Pilih Wilayah</option>
                            <option value="#">Palestine</option>
                            <option value="#">Syria</option>
                            <option value="#">Malaysia</option>
                            <option value="#">Thailand</option>
                        </select>
                    </div>
                    <div class="invalid-feedback">
                      please fill in your wilayah
                    </div>
                  </div>
                </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Register
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Register With Me</div>
                </div>
                <div class="row sm-gutters">
                    <div class="mt-3 mr-3 text-muted text-center">
                        Wilayah anda belum terdaftar ? <a href="{{ route('daftarwilayah')}}">Daftarkan Wilayah</a>
                    </div>

                    <div class="mt-2 text-muted text-center">
                        Sudah memiliki akun ?  <a href="login">Login</a>
                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{asset('assets/stisla/js/stisla.js')}}"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{asset('assets/stisla/js/scripts.js')}}"></script>
  <script src="{{asset('assets/stisla/js/custom.js')}}"></script>

  <!-- Page Specific JS File -->
</body>
</html>
