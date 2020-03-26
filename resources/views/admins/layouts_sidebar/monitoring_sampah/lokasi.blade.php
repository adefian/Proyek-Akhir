<!-- <title>Admin &mdash; Pimpinan</title> -->
@extends('layouts_admin.admin')

@if(auth()->user()->role == 'pimpinanecoranger')
    @include('admins.pimpinan.include')
@endif
@if(auth()->user()->role == 'petugaslapangan')
    @include('admins.petugas_lapangan.include')
@endif
@if(auth()->user()->role == 'komunitas')
    @include('admins.komunitas.include')
@endif

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Monitoring Tempat Sampah Pintar / Lokasi</h1>
          </div>
              
          <div class="section-body">
            @if(auth()->user()->role == 'pimpinanecoranger')
                <div class="card card-primary">
            @endif
            @if(auth()->user()->role == 'petugaslapangan')
                <div class="card card-success">
            @endif
            @if(auth()->user()->role == 'komunitas')
                <div class="card card-warning">
            @endif
                <div class="row">
                  <div class="col-12">
                  <div class="card-header">
                    <h4>Lokasi Tempat Sampah Pintar</h4>
                    <button data-toggle="modal" data-target="#modalCreate" class="btn btn-success fas fa-plus fa-2x" title="Tambahkan disini" style="margin-left: auto;"></button>
                  </div>
                  <div class="card-body pr-3 pl-4 m-1 table-responsive">
                    <table id="dataTable" class="table table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lokasi</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>
                                    <button data-toggle="modal" data-target="#modalCreate" class="btn btn-warning fa fa-edit" title="Edit disini"></button>
                                    <button data-toggle="modal" data-target="#modalCreate" class="btn btn-danger fa fa-trash" title="Hapus disini"></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Lokasi</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        </section>
    </div>

    @include('admins.layouts_sidebar.monitoring_sampah.tambah')

@endsection

@section('js')

    <script>
        //==========================Map Input=====================================

    function initialize() {
        //Cek Support Geolocation
        if(navigator.geolocation){

        //Mengambil Fungsi golocation
        navigator.geolocation.getCurrentPosition(lokasi);

        }
        else{

        alert("Maaf Browser tidak Support HTML 5");
        }


        //Variabel Marker

        var markerClick;

        //Tombol Hapus
        var hapus = document.getElementById('btn_hapus');

        hapus.addEventListener('click', function() {
        markerClick.setMap(null);
        navigator.geolocation.getCurrentPosition(lokasi);

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

            //Buat Peta
            var propertiPeta = {
                center: {lat: -8.408698, lng: 114.2339090},
                zoom: 9
            }

            var peta2 = new google.maps.Map(document.getElementById("mapInput"), propertiPeta);

            //Current Marker 
            var currentMarker = new google.maps.Marker({
                    position: latlong, 
                    icon : 'https://img.icons8.com/plasticine/40/000000/user-location.png',
                    map: peta2, 
                    title: "Anda Disini"
                }); 

            //Membuat Marker Map dengan Double Klik

            var latLng = new google.maps.LatLng(-8.408698,114.2339090);

            
            var addMarkerClick = google.maps.event.addListener(peta2,'dblclick',function(event) {
                
                markerClick = new google.maps.Marker({
                    position: event.latLng, 
                    map: peta2, 
                    icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
                    title: event.latLng.lat()+', '+event.latLng.lng()
                }); 

                currentMarker.setMap(null);

                google.maps.event.removeListener(addMarkerClick);

            
                //Kirim data ke form input dari double klik
                document.getElementById("lat").value = event.latLng.lat();
                document.getElementById("leng").value = event.latLng.lng(); 
            
                
            });

        }
    }
    </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnKRIk6ikiot_B-xKKZDvkzNWpYFjbgLs&callback=initialize"
  type="text/javascript"></script>

@endsection
