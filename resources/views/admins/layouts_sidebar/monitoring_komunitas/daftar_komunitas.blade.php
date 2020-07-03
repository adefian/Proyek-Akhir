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

@if(auth()->user()->role == 'pimpinankomunitas')
    @include('admins.pimpinan_komunitas.include')
@endif

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Monitoring Komunitas / Daftar Komunitas</h1>
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
              @if(auth()->user()->role == 'pimpinankomunitas')
                  <div class="card">
              @endif
                  <div class="card-wrap">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                          <div id="map" style="border-radius: 3px;"></div>
                        </div>
                        <div class="col-lg-6 col-12">
                          <h4 class="text-center mb-4 mt-4">Titik Lokasi Komunitas</h4>
                          @if(auth()->user()->role == 'pimpinanecoranger')
                              <button data-toggle="modal" data-target="#modalCreate" class="btn btn-success btn-sm fas fa-plus float-right mr-4" title="Tambahkan disini" style="margin-left: auto;"></button>
                          @endif
                          <div class="table-responsive">
                            <table class="table table-sm" id="dataTable">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th>Daerah</th>
                                  <th>Keterangan</th>
                                  <th></th>
                                  <th style="display:none;"></th>
                                  <th style="display:none;"></th>
                                  <th style="display:none;"></th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($data as $datas)
                                <tr>
                                  <th scope="row"> <i class="fas fa-users"></i> </th>
                                  <td>{{$datas->daerah}}</td>
                                  <td>{{$datas->keterangan}}</td>
                                  <td class="text-right">
                                  @if(auth()->user()->role == 'pimpinanecoranger')
                                  <button class="edit btn btn-warning btn-sm fa fa-edit" title="Edit disini"></button>

                                      @if(auth()->user()->role == 'pimpinanecoranger')
                                          <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$datas->id}})" data-target="#DeleteModal">
                                          <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus disini"></button>
                                          </a>
                                      @endif
                                      @if(auth()->user()->role == 'petugaslapangan')
                                          <a href="javascript:;" data-toggle="modal" onclick="deleteDatapetugaslap({{$datas->id}})" data-target="#DeleteModal">
                                          <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus disini"></button>
                                          </a>
                                      @endif
                                      @if(auth()->user()->role == 'komunitas')
                                          <a href="javascript:;" data-toggle="modal" onclick="deleteDatakomunitas({{$datas->id}})" data-target="#DeleteModal">
                                          <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus disini"></button>
                                          </a>
                                      @endif
                                  @endif
                                  </td>
                                  <td style="display:none;">{{$datas->id}}</td>
                                  <td style="display:none;">{{$datas->latitude}}</td>
                                  <td style="display:none;">{{$datas->longitude}}</td>
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

    <div id="DeleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p>Apakah anda yakin ingin menghapusnya ?</p>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('admins.layouts_sidebar.monitoring_komunitas.editlokasi')
    @include('admins.layouts_sidebar.monitoring_komunitas.tambahlokasi')

  <!-- ====================== Array ================== -->
    <script>
      var array = [];
    </script>

    @foreach ($data as $datas)
    <script>

      //Memasukkan data tabel ke array 
      array.push(['<?php echo $datas->latitude ?>','<?php echo $datas->longitude ?>','<?php echo $datas->daerah ?>','<?php echo $datas->keterangan ?>','<?php echo $datas->email ?>']);
    </script>
    @endforeach
  <!-- ====================== end Array ================== -->
@endsection

@section('js')

<!-- ====================== Maps ====================== -->

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

    //maps 
            var bounds = new google.maps.LatLngBounds();

            var maps = new google.maps.Map(document.getElementById("map"), {
              center : {lat: -8.408698, lng: 114.2339090},
              zoom : 9.5
            });

            var infoWindow = new google.maps.InfoWindow(), marker, i;

            for (var i = 0; i < array.length; i++) {
              
              var position = new google.maps.LatLng(array[i][0],array[i][1]);

              bounds.extend(position);

              var marker = new google.maps.Marker({

                position : position,
                map : maps,
                icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
                title : array[i][2]
              });

              google.maps.event.addListener(marker, 'click', (function(marker, i) {

                return function() {

                  var infoWindowContent = 
                  '<div class="content">'+
                  '<h6>'+array[i][2]+'</h6>'+
                  '<p>Titik Koordinat : '+array[i][0]+', '+array[i][1]+'<br/>'+
                  'Daerah : '+array[i][2]+'<br/>'+
                  'Keterangan : '+array[i][3]+'<br/>'+
                  'Email Penanggung Jawab : '+array[i][4]+'</p>'+

                  '</div>';

                  infoWindow.setContent(infoWindowContent);

                  infoWindow.open(maps, marker);
                }

              })(marker, i));
            }
          
        //maps

            //Variabel Marker

            var markers;
            var marker2;

            function taruhMarker(peta, posisiTitik){
                
                if( markers ){
                // pindahkan marker
                markers.setPosition(posisiTitik);
                } else {
                // buat marker baru
                markers = new google.maps.Marker({
                    position: posisiTitik,
                    map: peta,
                    icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
                });
                }
                
            }

            function taruhMarker2(peta2, posisiTitik2){
                
                if( marker2 ){
                // pindahkan marker
                marker2.setPosition(posisiTitik2);
                } else {
                // buat marker baru
                marker2 = new google.maps.Marker({
                    position: posisiTitik2,
                    map: peta2,
                    icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
                });
                }
                
            }

            //Buat Peta Input

            var peta = new google.maps.Map(document.getElementById("mapInput"), {
                    center: {lat: -8.408698, lng: 114.2339090},
                    zoom: 9
                });

            var peta2 = new google.maps.Map(document.getElementById("mapInput2"), {
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

                //============================== Edit ========================================================

                // Mengambil latitude longitude
                var latitude = parseFloat($('.latude').val());
                var longitude = parseFloat($('.longit').val());

                //Current Marker 
                var currentMarker2 = new google.maps.Marker({
                        // position: { lat: latitude, lng: longitude }, 
                        position : latlong,
                        icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
                        map: peta2, 
                        title: "Anda Disini"
                    }); 

                
                var addMarkerClick2 = google.maps.event.addListener(peta2,'click',function(event) {
                    
                    
                    taruhMarker2(this, event.latLng);

                    currentMarker2.setMap(null);

                    //Kirim data ke form input dari klik
                    document.getElementById("lat2").value = event.latLng.lat();
                    document.getElementById("leng2").value = event.latLng.lng(); 
                    
                });

                }
                
            }
        </script>
<!-- ======================== End Maps ====================== -->


<!-- ============================ Edit Data ========================== -->
  <script>
     
     $(document).ready(function() {
 
         var table = $('#dataTable').DataTable();
 
         table.on('click', '.edit', function (){
 
             $tr = $(this).closest('tr');
             if ($($tr).hasClass('child')) {
                 $tr = $tr.prev('.parent');
             }
 
             var data = table.row($tr).data();
             console.log(data);
 
             $('#daerah').val(data[1]);
             $('#keterangan').val(data[2]);
             $('#lat2').val(data[5]);
             $('#leng2').val(data[6]);
             
             $('#editForm').attr('action', '/daftarkomunitas/'+data[4]);
             $('#editFormpetugaslap').attr('action', '/daftarkomunitas-petugaslap/'+data[4]);
             $('#editFormkomunitas').attr('action', '/daftarkomunitas-komunitas/'+data[4]);
             $('#editModal').modal('show');
         });
 
      });
     </script>
<!-- ============================ End Edit Data ===================== -->
 
<!-- ============================ Hapus Data ========================== -->

     <script type="text/javascript">
      function deleteData(id)
      {
          var id = id;
          var url = '{{ route("daftarkomunitas.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatakomunitas(id)
      {
          var id = id;
          var url = '{{ route("daftarkomunitas-komunitas.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatapetugaslap(id)
      {
          var id = id;
          var url = '{{ route("daftarkomunitas-petugaslap.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }
 
      function formSubmit()
      {
          $("#deleteForm").submit();
      }
   </script>
<!-- ============================ End Hapus Data ========================== -->

    
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initialize"
  type="text/javascript"></script>
@endsection