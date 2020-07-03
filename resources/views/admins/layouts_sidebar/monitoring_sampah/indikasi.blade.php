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
                        <div class="col-lg-7 col-12">
                          <div id="map" style="border-radius: 3px;"></div>
                        </div>
                        <div class="col-lg-5 col-12">
                          <h6 class="text-center mb-4 mt-4">Titik Lokasi yang terdaftar</h6>
                          <div class="table-responsive">
                            <table class="table table-sm" id="dataTable">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th>daerah</th>
                                  <th class="text-center">Status</th>
                                  <th style="display:none;"></th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($data as $datas)
                                <tr>
                                  <td scope="row"> <i class="fas fa-trash"></i></td>
                                  <td>{{$datas->nama}}</td>
                                  <td class="text-center">
                                  @if($datas->status == 'kosong')
                                    <button class="edit btn btn-sm btn-success" style="width:100px;" title="Ubah disini">Kosong</button>
                                   @elseif($datas->status == 'penuh')
                                    <button class="edit btn btn-sm btn-danger" style="width:100px;" title="Ubah disini">Penuh</button>
                                   @elseif($datas->status == 'ambil')
                                    <button class="edit btn btn-sm btn-warning" style="width:100px;" title="Ubah disini">Pengambilan</button>
                                  @endif
                                  </td>
                                  <td style="display:none;">{{$datas->id}}</td>
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

        </section>
    </div>

<!-- Form indikasi sampah  -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body">

          <h3>Status saat ini <h3 id="status"></h3> </h3>
            @if(auth()->user()->role == 'pimpinanecoranger')
                <form method="POST" action="/ubahstatussampah" class="needs-validation" novalidate="" id="editForm" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'petugaslapangan')
                <form method="POST" action="/ubahstatussampah-petugaslap" class="needs-validation" novalidate="" id="editFormpetugaslap" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'komunitas')
                <form method="POST" action="/ubahstatussampah-komunitas" class="needs-validation" novalidate="" id="editFormkomunitas" method="POST" enctype="multipart/form-data">
            @endif
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <div class="form-group">
                    <div class="input-group">                      
                    <select name="status" type="text" class="form-control">
                        <option selected disabled>Ubah Status</option>
                        <option value="kosong">Kosong</option>
                        <option value="ambil">Pengambilan</option>
                        <option value="penuh">Penuh</option>
                      </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Ubah</button>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<!-- End Form indikasi sampah  -->

<!-- ============= Array ============= -->

    <script>
      var array =[];
    </script>

    @foreach ($data as $datas)

    <script type="text/javascript">

        //Memasukkan data tabel ke array
        array.push(['<?php echo $datas->nama?>','<?php echo $datas->latitude?>','<?php echo $datas->longitude?>','<?php echo $datas->petugasygmenambahkan->nama?>','<?php echo $datas->foto ?>']);

    </script> 

    @endforeach
  
<!-- ============= Array ============= -->
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
              'Penanggung Jawab : '+array[i][3]+'<br/>'+
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
 
             var element = document.getElementById("status");
             element.innerHTML = data[2];
            //  
             $('#editForm').attr('action', '/ubahstatussampah/'+data[3]);
             $('#editFormpetugaslap').attr('action', '/ubahstatussampah-petugaslap/'+data[3]);
             $('#editFormkomunitas').attr('action', '/ubahstatussampah-komunitas/'+data[3]);
             $('#editModal').modal('show');
         });
 
      });
     </script>
<!-- ============================ End Edit Data ===================== -->
    
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initMap" type="text/javascript"></script>

@endsection
