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
            <h1>Monitoring Komunitas / Lokasi</h1>
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
                          <h6 class="text-center mb-4">Titik Lokasi Komunitas</h6>
                              <button data-toggle="modal" data-target="#modalCreate" class="btn btn-success btn-sm fas fa-user-plus float-right mr-4" title="Tambahkan disini" style="margin-left: auto;"></button>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                              @foreach($data as $datas)
                                <tr>
                                  <th scope="row"> <i class="fas fa-users"></i> </th>
                                  <td style="max-width:165px;">{{$datas->nama}}</td>
                                  <td class="text-right">
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

                                  </td>
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
      array.push(['<?php echo $datas->latitude ?>','<?php echo $datas->longitude ?>','<?php echo $datas->nama ?>','<?php echo $datas->daerah ?>','<?php echo $datas->keterangan ?>']);
    </script>
    @endforeach
  <!-- ====================== end Array ================== -->
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
          
          var position = new google.maps.LatLng(array[i][0],array[i][1]);

          bounds.extend(position);

          var marker = new google.maps.Marker({

            position : position,
            map : peta,
            icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {

            return function() {

              var infoWindowContent = 
              '<div class="content">'+
              '<h6>'+array[i][2]+'</h6>'+
              '<p>Titik Koordinat : '+array[i][0]+', '+array[i][1]+'<br/>'+
              'Daerah : '+array[i][3]+'<br/>'
              'Keterangan : '+array[i][4]+'</p>'+
              '</div>';

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
 
             $('#nama').val(data[1]);
             $('#keterangan').val(data[2]);
             $('#jenis_agenda').val(data[3]);
             $('#tanggal').val(data[4]);
             
             $('#editForm').attr('action', '/daftarkomunitas/'+data[6]);
             $('#editFormpetugaslap').attr('action', '/daftarkomunitas-petugaslap/'+data[6]);
             $('#editFormkomunitas').attr('action', '/daftarkomunitas-komunitas/'+data[6]);
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

    
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initMap"
  type="text/javascript"></script>
@endsection