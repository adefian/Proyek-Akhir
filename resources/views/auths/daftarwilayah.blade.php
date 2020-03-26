<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Daftar Wilayah &mdash; TS</title>

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
              <div class="card-header"><h4>Daftarkan Komunitas</h4></div>

              <div class="card-body">
              <form method="POST" action="postlogin" class="needs-validation" novalidate="">
                  {{csrf_field()}}

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="daerah" class="control-label">Daerah</label>
                    </div>
                    <input id="daerah" type="daerah" class="form-control" name="daerah" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your daerah
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <div class="d-block">
                    	<label for="keterangan" class="control-label">Keterangan</label>
                    </div>
                    <input id="keterangan" type="keterangan" class="form-control" name="keterangan" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your keterangan
                    </div>
                  </div>
                
                <div class="row">
                 <div class="col-6">
                  <div class="form-group">
                    <div class="d-block">
                    	<label for="latitude" class="control-label">Latitude</label>
                    </div>
                    <input id="latitude" type="latitude" class="form-control" name="latitude" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your latitude
                    </div>
                  </div>
                 </div> 

                 <div class="col-6">
                 <div class="form-group">
                    <div class="d-block">
                    	<label for="longitude" class="control-label">Longitude</label>
                    </div>
                    <input id="longitude" type="longitude" class="form-control" name="longitude" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your longitude
                    </div>
                  </div>
                 </div> 
                </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Daftarkan
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Daftarkan Wilayah disini</div>
                </div>
                <div class="row sm-gutters">
                    <div class="mt-3 mr-5 text-muted text-center">
                        Daftar sebagai anggota ? <a href="{{ route('register')}}">Daftar</a>
                    </div>

                    <div class="mt-3 text-muted text-center">
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
