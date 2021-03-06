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

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css">
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Monitoring Komunitas / Kelola Agenda</h1>
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
                    <h4>Kelola Agenda</h4>
                    <button data-toggle="modal" data-target="#modalCreate" class="btn btn-success fas fa-plus fa-2x" title="Tambahkan disini" style="margin-left: auto;"></button>
                  </div>
                <div class="card-body pr-3 pl-4 m-1 table-responsive">
                    <table id="dataTable" class="table table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama kegiatan</th>
                                <th>Komunitas</th>
                                <th>Keterangan</th>
                                <th>Jenis Agenda</th>
                                <th>Tanggal</th>
                                <th>Yang Menambahkan</th>
                                <th class="text-center">Aksi</th>
                                <th style="display:none;">id</th>
                                <th style="display:none;">tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(auth()->user()->role == 'pimpinanecoranger')
                            @if($data)
                                @php $no = 1 @endphp
                                @foreach($data as $datas)
                                    <tr>
                                        <td class="text-center">{{$no++}}</td>
                                        <td>{{$datas->nama}}</td>
                                        <td>{{$datas->komunitas->daerah}}</td>
                                        <td>{{$datas->keterangan}}</td>
                                        <td>
                                        @if($datas->jenis_agenda == 1)
                                            <span style="width:100%; align:center;" class="badge badge-warning">Agenda Mendesak</span>
                                            @else
                                            <span style="width:100%; align:center;" class="badge badge-success">Agenda tidak Mendesak</span>
                                        @endif
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($datas->tanggal)->isoFormat('LLLL') }} WIB</td>
                                        <td>{{$datas->petugasygmenambahkan->nama}}</td>
                                        <td style="display:none;">{{$datas->id}}</td>
                                        <td class="text-center">

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
                                        <td style="display:none;">{{date("Y-m-d\TH:i",strtotime($datas->tanggal))}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @elseif(auth()->user()->role == 'komunitas')
                            @if($komunitas)
                                @php $no = 1 @endphp
                                @foreach($komunitas as $kom)
                                    <tr>
                                        <td class="text-center">{{$no++}}</td>
                                        <td>{{$kom->nama}}</td>
                                        <td>{{$kom->komunitas->daerah}}</td>
                                        <td>{{$kom->keterangan}}</td>
                                        <td>
                                        @if($kom->jenis_agenda == 1)
                                            <span style="width:100%; align:center;" class="badge badge-warning">Agenda Mendesak</span>
                                            @else
                                            <span style="width:100%; align:center;" class="badge badge-success">Agenda tidak Mendesak</span>
                                        @endif
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($kom->tanggal)->isoFormat('LLLL') }}</td>
                                        <td>{{$kom->petugasygmenambahkan->nama}}</td>
                                        <td style="display:none;">{{$kom->id}}</td>
                                        <td style="display:none;">{{$kom->jenis_agenda}}</td>
                                        <td class="text-center">

                                            <button class="edit btn btn-warning btn-sm fa fa-edit" title="Edit disini"></button>

                                            @if(auth()->user()->role == 'pimpinanecoranger')
                                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$kom->id}})" data-target="#DeleteModal">
                                                <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus disini"></button>
                                                </a>
                                            @endif
                                            @if(auth()->user()->role == 'petugaslapangan')
                                                <a href="javascript:;" data-toggle="modal" onclick="deleteDatapetugaslap({{$kom->id}})" data-target="#DeleteModal">
                                                <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus disini"></button>
                                                </a>
                                            @endif
                                            @if(auth()->user()->role == 'komunitas')
                                                <a href="javascript:;" data-toggle="modal" onclick="deleteDatakomunitas({{$kom->id}})" data-target="#DeleteModal">
                                                <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus disini"></button>
                                                </a>
                                            @endif
                                        </td>
                                        <td style="display:none;">{{date("Y-m-d\TH:i",strtotime($kom->tanggal))}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama kegiatan</th>
                                <th>Komunitas</th>
                                <th>Keterangan</th>
                                <th>Jenis Agenda</th>
                                <th>Tanggal</th>
                                <th>Yang Menambahkan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
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

    @include('admins.layouts_sidebar.monitoring_komunitas.edit')
    @include('admins.layouts_sidebar.monitoring_komunitas.tambah')

@endsection

@section('js')

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
             $('#keterangan').val(data[3]);
             $('#tanggal').val(data[9]);

             var element = document.getElementById("jenis_agenda");
             element.innerHTML = data[4];
             
             $('#editForm').attr('action', '/kelolaagenda/'+data[7]);
             $('#editFormpetugaslap').attr('action', '/kelolaagenda-petugaslap/'+data[7]);
             $('#editFormkomunitas').attr('action', '/kelolaagenda-komunitas/'+data[7]);
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
          var url = '{{ route("kelolaagenda.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatakomunitas(id)
      {
          var id = id;
          var url = '{{ route("kelolaagenda-komunitas.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatapetugaslap(id)
      {
          var id = id;
          var url = '{{ route("kelolaagenda-petugaslap.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }
 
      function formSubmit()
      {
          $("#deleteForm").submit();
      }
   </script>
<!-- ============================ End Hapus Data ========================== -->

<!-- ============================ Datetimepicker ========================== -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
      <script>
        $(function(){
          $('#tanggal1').datetimepicker();

        });
      </script>

<!-- ============================ End  ========================== -->

@endsection