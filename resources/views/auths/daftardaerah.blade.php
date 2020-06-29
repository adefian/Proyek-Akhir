<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Daftar Komunitas &mdash; </title>

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

  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/5eea12909e5f69442290c021/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>
  <!--End of Tawk.to Script-->
  @include('sweet::alert')
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-11 col-md-10 col-lg-10 col-xl-10">
            <div class="card card-primary mb-5">
              <div class="card-header"><h4>Daftarkan Komunitas</h4></div>
                <div class="card-body">
                  <form method="POST" action="postdaftardaerah" class="needs-validation" novalidate="">
                      {{csrf_field()}}
                    <div class="row">
                      <div class="col-12 col-lg-6">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                          <div class="invalid-feedback">
                            Silahkan isi Email Anda
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="d-block">
                            <label for="daerah" class="control-label">Nama Daerah</label>
                          </div>
                          <input id="daerah" type="daerah" class="form-control" name="daerah" tabindex="2" required>
                          <div class="invalid-feedback">
                            Silahkan isi Nama Daerah Anda
                          </div>
                        </div>
                      
                        <div class="form-group">
                          <div class="d-block">
                            <label for="keterangan" class="control-label">Keterangan</label>
                          </div>
                          <textarea id="keterangan" type="keterangan" class="form-control" name="keterangan" tabindex="2" required></textarea>
                          <p class="text-danger">Kenapa anda ingin mendaftarkan daerah ini.</p>
                          <div class="invalid-feedback">
                            Silahkan isi Keterangan
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-12 col-lg-6">
                        <div id="mapInput" style="width: 100%; height: 320px; border-radius: 3px;"></div>
                        <p class="text-danger">klik satu kali untuk menentukan posisi.</p>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <div class="d-block">
                            <label for="latitude" class="control-label">Latitude</label>
                          </div>
                          <input type="number" step="any" id="lat" class="form-control" name="latitude" required>
                          <div class="invalid-feedback">
                          Silahkan isi Koordinat Latitude
                          </div>
                        </div>
                      </div> 

                      <div class="col-6">
                        <div class="form-group">
                            <div class="d-block">
                              <label for="longitude" class="control-label">Longitude</label>
                            </div>
                            <input type="number" step="any" id="leng" class="form-control" name="longitude" required>
                            <div class="invalid-feedback">
                            Silahkan isi Koordinat Longitude
                            </div>
                          </div>
                        </div> 
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-klik btn-lg btn-block" tabindex="4">
                        Daftarkan
                      </button>
                    </div>
                  </form>
                  <div class="text-center mt-4 mb-3">
                    <div class="text-job text-muted">Daftarkan Daerah Anda disini</div>
                  </div>

                  <div class="row sm-gutters">
                      <div class="mt-3 mr-5 text-muted text-center">
                          Daftar sebagai anggota komunitas ? <a href="{{ route('register')}}">Daftar</a>
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

<!-- ====================== Input Map ====================== -->

  <script>

  function initialize() {
    //Cek Support Geolocation
    if(navigator.geolocation){

    //Mengambil Fungsi golocation
    navigator.geolocation.getCurrentPosition(lokasi);

    }
    else{

    swal("Maaf Browser tidak Support HTML 5");
    }


    //Variabel Marker

    var marker;

    function taruhMarker(peta, posisiTitik){
        
        if( marker ){
        // pindahkan marker
        marker.setPosition(posisiTitik);
        } else {
        // buat marker baru
        marker = new google.maps.Marker({
            position: posisiTitik,
            map: peta,
            icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
        });
        }
        
    }

    //Buat Peta

    var peta = new google.maps.Map(document.getElementById("mapInput"), {
            center: {lat: -8.408698, lng: 114.2339090},
            zoom: 9
        });


    //Fungsi untuk geolocation
    function lokasi(position){

        //Mengirim data koordinat ke form input
        document.getElementById("lat").value = position.coords.latitude;
        document.getElementById("leng").value = position.coords.longitude;

        //Current Location
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var latlong = new google.maps.LatLng(lat, long);

        //Current Marker 
        var currentMarker = new google.maps.Marker({
                position: latlong, 
                icon : 'https://img.icons8.com/plasticine/40/000000/user-location.png',
                map: peta, 
                title: "Anda Disini"
            }); 

        //Membuat Marker Map dengan Klik

        var latLng = new google.maps.LatLng(-8.408698,114.2339090);

        
        var addMarkerClick = google.maps.event.addListener(peta,'click',function(event) {
            
            
            taruhMarker(this, event.latLng);

        
            //Kirim data ke form input dari klik
            document.getElementById("lat").value = event.latLng.lat();
            document.getElementById("leng").value = event.latLng.lng(); 
            
        });
      }
        
    }
  </script>
<!-- ====================== End Input Map ====================== -->


  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{asset('assets/stisla/js/stisla.js')}}"></script>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initialize" type="text/javascript"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{asset('assets/stisla/js/scripts.js')}}"></script>
  <script src="{{asset('assets/stisla/js/custom.js')}}"></script>
  
  <!-- Page Specific JS File -->

</html>
