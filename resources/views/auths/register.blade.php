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
  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="shortcut icon" href="{{asset('assets/img/pick me up.png')}}">
</head>
<style>
    body {
    background-color: #6777ef; 
    -webkit-animation: color 12s ease-in  0s infinite alternate running;
    -moz-animation: color 12s linear  0s infinite alternate running;
    animation: color 12s linear  0s infinite alternate running;
    }

    @-webkit-keyframes color {
        0% { background-color: #6777ef; }
        25% { background-color: #67b7ef; }
        55% { background-color: #2855a7; }
        75% { background-color: #07a3ff; }
        100% { background-color: #2163f7f2; }
    }
  }
</style>
<body>

  @include('sweet::alert')

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
              <form method="POST" action="postregister" class="needs-validation" novalidate="">
                  {{csrf_field()}}

                <div class="row">
                 <div class="col-6">
                  <div class="form-group">
                    <div class="d-block">
                    	<label for="nama" class="control-label">Nama</label>
                    </div>
                    <input id="nama" type="nama" class="form-control" name="nama" tabindex="2" required>
                    <div class="invalid-feedback">
                    Silahkan isi Nama Anda 
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
                    Silahkan isi Username Anda
                    </div>
                  </div>
                 </div> 
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                    Silahkan isi Email Anda
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                    Silahkan isi Password Anda
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
                    Silahkan isi Alamat Anda
                    </div>
                  </div>
                 </div> 

                 <div class="col-6">
                 <div class="form-group">
                    <div class="d-block">
                    	<label for="nohp" class="control-label">No Hp</label>
                    </div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">+62</span>
                      </div>
                      <input id="nohp" type="nohp" class="form-control" name="nohp" tabindex="2" required>
                    </div>
                    <div class="invalid-feedback">
                    Silahkan isi No Handphone Anda / yang dapat dihubungi
                    </div>
                  </div>
                 </div> 
                </div>

                <div class="row">
                  <div class="form-group col-6">
                    <div class="d-block">
                    	<label for="jenis_kelamin" class="control-label">Jenis Kelamin</label>
                    </div>
                      <select name="jenis_kelamin" type="text" class="form-control">
                        <option selected disabled>Pilih Jenis kelamin</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    <div class="invalid-feedback">
                    Silahkan isi Jenis Kelamin Anda
                    </div>
                  </div>

                 <div class="form-group col-6">
                    <div class="d-block">
                        <label for="daerah" class="control-label">Daerah</label>
                    </div>
                        <select name="daerah" type="text" class="form-control">
                            <option selected disabled>Pilih Daerah</option>
                            @foreach($data as $datas)
                                <option value="{{$datas->id}}">{{$datas->daerah}}</option>
                            @endforeach
                            
                        </select>
                    <div class="invalid-feedback">
                      please fill in your daerah 
                    </div>
                  </div>
                </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-klik btn-lg btn-block" tabindex="4">
                      Register
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Register With Me</div>
                </div>
                <div class="row sm-gutters">
                    <div class="mt-3 mr-3 text-muted text-center">
                        Daerah anda belum terdaftar ? <a href="{{ route('daftardaerah')}}">Daftarkan Daerah</a>
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
  <svg class="hero-waves fixed-bottom" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

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
