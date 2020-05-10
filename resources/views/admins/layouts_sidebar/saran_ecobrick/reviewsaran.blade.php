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
            <h1>Review Saran Ecobrick</h1>
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
                    <h4>Saran Ecobrick</h4>
                    <button data-toggle="modal" data-target="#modalCreate" class="btn btn-success fas fa-plus fa-2x" title="Tambahkan disini" style="margin-left: auto;"></button>
                  </div>
                    <div class="card-body pr-3 pl-4 m-1 table-responsive">
                        <table id="dataTable" class="table table-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengirim</th>
                                    <th>Foto Yang Diusulkan</th>
                                    <th>Keterangan</th>
                                    <th class="text-center">Level</th>
                                    <th>Foto Yang Diaplikasikan</th>
                                    <th class="text-center">Aksi</th>
                                    <th style="display:none;">id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                    @php $no = 1 @endphp
                                    @foreach($data as $datas)
                                        <tr>
                                            <td class="text-center align-middle">{{$no++}}</td>
                                            <td class="align-middle">{{$datas->nama_pengirimsaran}}</td>
                                            <td class="align-middle">
                                            @if($datas->foto_diusulkan)
                                                <img height="100" id="myImg" src="{{asset('assets/img/ecobrick')}}/{{$datas->foto_diusulkan}}" data-toggle="modal" data-target="#myModal"></img>
                                                @else
                                                -
                                            @endif
                                            </td>
                                            <td class="align-middle">{{$datas->keterangan}}</td>
                                            <td class="align-middle">
                                            @if($datas->level == 1)
                                                <span style="width:100%; align:center;" class="badge badge-success">Akan/sudah diaplikasikan</span>
                                                @else
                                                <span style="width:100%; align:center;" class="badge badge-warning">Belum diaplikasikan</span>
                                            @endif
                                            </td>
                                            <td class="text-center align-middle">
                                            @if($datas->foto_diaplikasikan)
                                                <img height="100" src="{{asset('assets/img/ecobrick')}}/{{$datas->foto_diaplikasikan}}" alt=""></img>
                                                @else
                                                -
                                            @endif
                                            </td>
                                            <td style="display:none;">{{$datas->id}}</td>
                                            <td class="text-center align-middle">

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
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengirim</th>
                                    <th>Foto Yang Diusulkan</th>
                                    <th>Keterangan</th>
                                    <th class="text-center">Level</th>
                                    <th>Foto Yang Diaplikasikan</th>
                                    <th class="text-center">Aksi</th>
                                    <th style="display:none;">id</th>
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

    @include('admins.layouts_sidebar.saran_ecobrick.edit')
    @include('admins.layouts_sidebar.saran_ecobrick.tambah')
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
             $('#keterangan').val(data[2]);
             $('#jenis_agenda').val(data[7]);
             $('#tanggal').val(data[4]);
             
             $('#editForm').attr('action', '/reviewsaranecobrick/'+data[6]);
             $('#editFormpetugaslap').attr('action', '/reviewsaranecobrick-petugaslap/'+data[6]);
             $('#editFormkomunitas').attr('action', '/reviewsaranecobrick-komunitas/'+data[6]);
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
          var url = '{{ route("reviewsaranecobrick.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatakomunitas(id)
      {
          var id = id;
          var url = '{{ route("reviewsaranecobrick-komunitas.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatapetugaslap(id)
      {
          var id = id;
          var url = '{{ route("reviewsaranecobrick-petugaslap.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }
 
      function formSubmit()
      {
          $("#deleteForm").submit();
      }
   </script>
<!-- ============================ End Hapus Data ========================== -->
@endsection