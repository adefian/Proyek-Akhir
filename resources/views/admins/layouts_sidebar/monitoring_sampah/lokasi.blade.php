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
                                <th style="display:none;">id</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($data)
                        @php $no = 1 @endphp
                        @foreach($data as $datas)
                            <tr>
                                <td class="text-center">{{$no++}}</td>
                                <td>{{$datas->nama}}</td>
                                <td>{{$datas->latitude}}</td>
                                <td>{{$datas->longitude}}</td>
                                <td style="display:none;">{{$datas->id}}</td>
                                <td>
                                    @if($datas->status === 'kosong')
                                        <span class="badge badge-success">Kosong</span>
                                        @elseif($datas->status === 'penuh')
                                        <span class="badge badge-danger">Penuh</span>
                                        @else
                                        <span class="badge badge-warning">Pengambilan</span>
                                    @endif
                                </td>
                                <td class="text-center">

                                    <button id="edit" class="edit btn btn-warning btn-sm fa fa-edit" title="Edit disini"></button>

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
                        @endif
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
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

    @include('admins.layouts_sidebar.monitoring_sampah.tambah')

    @include('admins.layouts_sidebar.monitoring_sampah.edit')
@endsection

@section('js')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initialize" type="text/javascript"></script>
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6d0TRSHF8IPNmHvZG6c3OY8WLOkAwxC0&callback=initialize" type="text/javascript"></script> -->


<!-- ====================== Hapus Data ====================== -->

    <script type="text/javascript">
      function deleteData(id)
      {
          var id = id;
          var url = '{{route("indikasi.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatakomunitas(id)
      {
          var id = id;
          var url = '{{route("indikasi-komunitas.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatapetugaslap(id)
      {
          var id = id;
          var url = '{{route("indikasi-petugaslap.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }
 
      function formSubmit()
      {
          $("#deleteForm").submit();
      }
   </script>

<!-- ====================== End Hapus Data ===================== -->

<!-- ====================== Edit Data ====================== -->
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
             $('.latude').val(data[2]);
             $('.longit').val(data[3]);
            //  $('#status').val(data[5]);
             
             $('#editForm').attr('action', 'indikasi/'+data[4]);
             $('#editFormpetugaslap').attr('action', 'indikasi-petugaslap/'+data[4]);
             $('#editFormkomunitas').attr('action', 'indikasi-komunitas/'+data[4]);
             $('#editModal').modal('show');
         });

         
 
      });

    

     </script>   
<!-- ====================== End Edit Data ====================== -->

<!-- ====================== Input Map ====================== -->

    <script>

        function initialize() {
            //Cek Support Geolocation
            if(navigator.geolocation){

            //Mengambil Fungsi golocation
            navigator.geolocation.getCurrentPosition(lokasi);

            }
            else{

            swal("Maaf Browser tidak Support Untuk Menambahkan lokasi map");
            }


            //Variabel Marker

            var marker;
            var marker2;

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

            //Buat Peta

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
                        position: latlong, 
                        icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
                        map: peta2, 
                        title: "Lokasi Awal"
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
<!-- ====================== End Input Map ====================== -->

@endsection
