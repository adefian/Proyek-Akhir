@extends('layouts_admin.admin')

@section('css')
    <style>
      #map {height:450px;};
    </style>
@endsection

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
            <h1>Monitoring Tempat Sampah Pintar / Indikasi Sampah Penuh</h1>
          </div>

          <div class="row">
              <div class="col-12">
              @if(auth()->user()->role == 'pimpinanecoranger')
                <div class="card card-primary">
              @endif
              @if(auth()->user()->role == 'petugaslapangan')
                  <div class="card card-success">
              @endif
              @if(auth()->user()->role == 'komunitas')
                  <div class="card card-warning">
              @endif
                  <div class="card-wrap">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                          <div id="map"></div>
                        </div>
                        <div class="col-5">
                          <h6 class="text-center mb-4">Titik Lokasi yang terdaftar</h6>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th scope="row"> <i class="fas fa-trash"></i> </th>
                                  <td>Banyuwangi</td>
                                  <td>
                                    <button class="btn btn-success mr-1" style="width:100px;">Kosong</button>
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row"> <i class="fas fa-trash"></i> </th>
                                  <td>Pulau Merah</td>
                                  <td>
                                    <button class="btn btn-danger" style="width:100px;">Penuh</button>
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row"> <i class="fas fa-trash"></i> </th>
                                  <td>Pancer</td>
                                  <td>
                                    <button class="btn btn-warning" style="width:100px;">Hampir</button>
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row"> <i class="fas fa-trash"></i> </th>
                                  <td>Pantai Grajagan</td>
                                  <td>
                                    <button class="btn btn-danger" style="width:100px;">Penuh</button>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>

            
              
          <div class="section-body">
          </div>
        </section>
    </div>
@endsection

@section('js')

    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -8.408698, lng: 114.2339090},
          zoom: 9.5
        });
        infoWindow = new google.maps.InfoWindow;

        var marker = new google.maps.Marker({
          position: {lat: -8.208698, lng: 114.3739090},
          map: map,
          title: 'Banyuwangi'
        });
        var marker = new google.maps.Marker({
          position: {lat: -8.5986634, lng: 114.0048919},
          map: map,
          title: 'Pancer'
        });
        var marker = new google.maps.Marker({
          position: {lat: -8.6083443, lng: 114.2348919},
          map: map,
          title: 'Pantai Grajagan Banyuwangi'
        });

        var marker = new google.maps.Marker({
          position: {lat: -8.5982537, lng: 114.0294512},
          map: map,
          title: 'Pulau Merah'
        });

        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
        

      }

      
    </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnKRIk6ikiot_B-xKKZDvkzNWpYFjbgLs&callback=initMap"
  type="text/javascript"></script>
@endsection
