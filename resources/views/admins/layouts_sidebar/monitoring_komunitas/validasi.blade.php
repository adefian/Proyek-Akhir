@extends('layouts_admin.admin')

@section('css')
    <style>
      #map {height:350px;};
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
                <h1>Data Komunitas / Validasi</h1>
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
                  <div class="card">
                    <div class="card-header">
                        <h4>Validasi Komunitas</h4>
                    </div>
                    <div class="card-body pr-3 pl-4 m-1 table-responsive">
                        <table id="dataTable" class="table table-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Daerah</th>
                                    <th>Keterangan</th>
                                    <th>Email yang Menambahkan</th>
                                    <th>diajukan pada</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                    <th style="display:none;">id</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $no = 1 @endphp
                            @foreach($data as $datas)
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td>{{$datas->daerah}}</td>
                                    <td>{{$datas->keterangan}}</td>
                                    <td>{{$datas->email}}</td>
                                    <td>{{$datas->created_at->diffForHumans()}}</td>
                                    <td>
                                        <span class="badge badge-warning">Belum Tervalidasi</span>
                                    </td>
                                    <td style="display:none;">{{$datas->id}}</td>
                                    <td class="text-center">

                                        <button class="edit btn btn-warning btn-sm fa fa-edit" title="Edit disini"></button>

                                        @if(auth()->user()->role == 'pimpinanecoranger')
                                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$datas->id}})" data-target="#DeleteModal">
                                            <button class="btn btn-danger btn-sm fa fa-trash" title="Validasi ditolak"></button>
                                            </a>
                                        @endif
                                        @if(auth()->user()->role == 'petugaslapangan')
                                            <a href="javascript:;" data-toggle="modal" onclick="deleteDatapetugaslap({{$datas->id}})" data-target="#DeleteModal">
                                            <button class="btn btn-danger btn-sm fa fa-trash" title="Validasi ditolak"></button>
                                            </a>
                                        @endif
                                        @if(auth()->user()->role == 'komunitas')
                                            <a href="javascript:;" data-toggle="modal" onclick="deleteDatakomunitas({{$datas->id}})" data-target="#DeleteModal">
                                            <button class="btn btn-danger btn-sm fa fa-trash" title="Validasi ditolak"></button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div id="map" style="border-radius: 3px;"></div>
                    </div>
                  </div>
                 </div>
                </div>
            </div>
        </section>
    </div>

<!-- ====================== Form delete data ====================== -->
    <div id="DeleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Belum memenuhi syarat Validasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('GET') }}
                        <p>Apakah anda yakin tidak melakukan validasi pada komunitas ini ?</p>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- ====================== End Form delete data ====================== -->

<!-- ====================== Form validasi komunitas ===================== -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Daerah <p id="daerah"></p></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body">

          <h3><p id="val"></p></h3>
            @if(auth()->user()->role == 'pimpinanecoranger')
                <form method="POST" action="/editvalidasi" class="needs-validation" novalidate="" id="editForm" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'petugaslapangan')
                <form method="POST" action="/editvalidasi-petugaslap" class="needs-validation" novalidate="" id="editFormpetugaslap" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'komunitas')
                <form method="POST" action="/editvalidasi-komunitas" class="needs-validation" novalidate="" id="editFormkomunitas" method="POST" enctype="multipart/form-data">
            @endif
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <div class="input-group">                      
                    <select name="level" type="text" class="form-control">
                        <option selected disabled>Pilih</option>
                        <option value="1">Lakukan Validasi data</option>
                      </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Validasi</button>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<!-- ====================== End Form validasi komunitas ===================== -->

<!-- ============= Array ============= -->

    <script>
      var array =[];
    </script>

    @foreach ($data as $datas)

    <script type="text/javascript">

        //Memasukkan data tabel ke array
        array.push(['<?php echo $datas->daerah?>','<?php echo $datas->latitude?>','<?php echo $datas->longitude?>','<?php echo $datas->keterangan?>','<?php echo $datas->email?>']);

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
         zoom : 9
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
             '<p>Titik Koordinat : '+array[i][1]+', '+array[i][2]+'<br/>'+
             'Daerah : '+array[i][0]+'<br/>'+
             'Keterangan : '+array[i][3]+'<br/>'+
             'Email yang menambahkan : '+array[i][4]+'</p>'+
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
 
             var element = document.getElementById("val");
             element.innerHTML = data[5];
             var element = document.getElementById("daerah");
             element.innerHTML = data[1];
            //  
             $('#editForm').attr('action', '/validasi/'+data[6]);
             $('#editFormpetugaslap').attr('action', '/validasi-petugaslap/'+data[6]);
             $('#editFormkomunitas').attr('action', '/validasi-komunitas/'+data[6]);
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
          var url = '{{ route("validasi.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatakomunitas(id)
      {
          var id = id;
          var url = '{{ route("validasi-komunitas.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatapetugaslap(id)
      {
          var id = id;
          var url = '{{ route("validasi-petugaslap.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }
 
      function formSubmit()
      {
          $("#deleteForm").submit();
      }
   </script>
<!-- ============================ End Hapus Data ========================== -->

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initMap" type="text/javascript"></script>

@endsection