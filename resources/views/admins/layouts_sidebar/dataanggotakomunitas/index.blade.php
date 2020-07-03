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
@if(auth()->user()->role == 'pimpinankomunitas')
    @include('admins.pimpinan_komunitas.include')
@endif

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Anggota Komunitas</h1>
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
            @if(auth()->user()->role == 'pimpinankomunitas')
                <div class="card">
            @endif
                <div class="row">
                  <div class="col-12">
                  <div class="card-header">
                    <h4>Anggota komunitas</h4>
                  </div>
                  <div class="card-body pr-3 pl-4 m-1 table-responsive">
                    <table id="dataTable" class="table table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                            @if(auth()->user()->role == 'pimpinanecoranger')
                                <th>Daerah</th>
                            @endif
                            @if(auth()->user()->role == 'pimpinankomunitas')
                                <th style="display:none;">Daerah</th>
                            @endif
                                <th>Aksi</th>
                                <th style="display:none;">id</th>
                                <th style="display:none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(auth()->user()->role == 'pimpinanecoranger')
                        @php $no = 1 @endphp
                        @foreach($data as $datas)
                            <tr>
                                <td class="text-center">{{$no++}}</td>
                                <td>{{$datas->nama}}</td>
                                <td>{{$datas->akun->email}}</td>
                                <td> {{$datas->nohp}}</td>
                                <td>{{$datas->alamat}}</td>
                                <td>{{$datas->daerahygdipilih->daerah}}</td>
                                <td style="display:none;">{{$datas->id}}</td>
                                <td style="display:none;">{{$datas->nohp}}</td>
                                <td class="text-center">

                                    <button class="edit btn btn-warning btn-sm fa fa-user-edit" title="Edit disini"></button>

                                    @if(auth()->user()->role == 'pimpinanecoranger')
                                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$datas->id}})" data-target="#DeleteModal">
                                        <button class="btn btn-danger btn-sm fa fa-user-minus" title="Hapus disini"></button>
                                        </a>
                                    @endif
                                    @if(auth()->user()->role == 'pimpinankomunitas')
                                        <a href="javascript:;" data-toggle="modal" onclick="deleteDatapimpinankom({{$datas->id}})" data-target="#DeleteModal">
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
                        @if(auth()->user()->role == 'pimpinankomunitas')
                        @php $no = 1 @endphp
                        @foreach($dataperkomunitas as $datas)
                            <tr>
                                <td class="text-center">{{$no++}}</td>
                                <td>{{$datas->nama}}</td>
                                <td>{{$datas->akun->email}}</td>
                                <td> {{$datas->nohp}}</td>
                                <td>{{$datas->alamat}}</td>
                                <td style="display:none;">{{$datas->daerahygdipilih->daerah}}</td>
                                <td style="display:none;">{{$datas->id}}</td>
                                <td style="display:none;">{{$datas->nohp}}</td>
                                <td class="text-center">

                                    <button class="edit btn btn-warning btn-sm fa fa-user-edit" title="Edit disini"></button>

                                    @if(auth()->user()->role == 'pimpinanecoranger')
                                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$datas->id}})" data-target="#DeleteModal">
                                        <button class="btn btn-danger btn-sm fa fa-user-minus" title="Hapus disini"></button>
                                        </a>
                                    @endif
                                    @if(auth()->user()->role == 'pimpinankomunitas')
                                        <a href="javascript:;" data-toggle="modal" onclick="deleteDatapimpinankom({{$datas->id}})" data-target="#DeleteModal">
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
          </div>
        </section>
    </div>

<!-- ======================== Hapus Data ======================== -->
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
<!-- ======================== End Hapus Data ======================== -->

    @include('admins.layouts_sidebar.dataanggotakomunitas.edit')
    

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
             $('#email').val(data[2]);
             $('#nohp').val(data[7]);
             $('#alamat').val(data[4]);
             
             $('#editForm').attr('action', '/dataanggotakomunitas/'+data[6]);
             $('#editFormpimpinankom').attr('action', '/dataanggotakomunitas-pimpinankom/'+data[6]);
             $('#editFormkomunitas').attr('action', '/dataanggotakomunitas-komunitas/'+data[6]);
             $('#editModal').modal('show');
         });
 
      });
     </script>
 
 <!-- ============================ Hapus Data ========================== -->

     <script type="text/javascript">
      function deleteData(id)
      {
          var id = id;
          var url = '{{ route("dataanggotakomunitas.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatakomunitas(id)
      {
          var id = id;
          var url = '{{ route("dataanggotakomunitas-komunitas.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatapimpinankom(id)
      {
          var id = id;
          var url = '{{ route("dataanggotakomunitas-pimpinankom.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }
 
      function formSubmit()
      {
          $("#deleteForm").submit();
      }
   </script>
@endsection
