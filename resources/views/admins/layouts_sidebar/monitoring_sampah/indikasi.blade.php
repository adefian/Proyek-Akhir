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
                          <div id="map" style="border-radius: 3px;"></div>
                        </div>
                        <div class="col-5">
                          <h6 class="text-center mb-4">Titik Lokasi yang terdaftar</h6>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                              @foreach($data as $datas)
                                <tr>
                                  <th scope="row"> <i class="fas fa-trash"></i> </th>
                                  <td>{{$datas->namalokasi}}</td>
                                  <td>
                                  @if($datas->status === 0)
                                    <button class="btn btn-success mr-1" style="width:100px;">Kosong</button>
                                   @elseif($datas->status === 1)
                                    <button class="btn btn-danger mr-1" style="width:100px;">Penuh</button>
                                  </td>
                                  @endif
                                </tr>
                              @endforeach
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

    <script>
      var array =[];
    </script>

    @foreach ($data as $datas)

    <script type="text/javascript">

        //Memasukkan data tabel ke array
        array.push(['<?php echo $datas->namalokasi?>','<?php echo $datas->latitude?>','<?php echo $datas->longitude?>','<?php echo $datas->petugasygmenambahkan->nama?>','<?php echo $datas->foto ?>']);

    </script> 

    @endforeach

@endsection

@section('js')
    

<!-- ============================ Maps ===================== -->

    <script>
     
      function initMap() {

        var bounds = new google.maps.LatLngBounds();

        var peta = new google.maps.Map(document.getElementById("map"), {
          center : {lat: -8.408698, lng: 114.2339090},
          zoom : 9.5
        });

        var infoWindow = new google.maps.InfoWindow(), marker, i;

        for (var i = 0; i < array.length; i++) {
          
          var position = new google.maps.LatLng(array[i][1],array[i][2]);

          bounds.extend(position);

          var marker = new google.maps.Marker({

            position : position,
            map : peta,
            icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
            title : array[i][0]
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {

            return function() {

              var infoWindowContent = 
              '<div class="content"><p>'+
              '<h6>'+array[i][0]+'</h6>'+
              '<img height="130" style="margin:0 auto; display:block;" src="assets/img/tempatsampah/'+array[i][4]+'"/><br/>'+
              'Petugas yang Menambahkan : '+array[i][3]+'<br/>'+
              'Titik Koordinat : '+array[i][1]+', '+array[i][2]+'<br/>'+
              '</p></div>';

              infoWindow.setContent(infoWindowContent);

              infoWindow.open(peta, marker);
            }

          })(marker, i));
        }
       
      }
      
    </script>
<!-- ============================ End Maps ===================== -->
    
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initMap" type="text/javascript"></script>

@endsection
