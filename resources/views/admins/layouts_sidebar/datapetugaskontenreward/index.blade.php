@extends('layouts_admin.admin')

@if(auth()->user()->role == 'pimpinanecoranger')
    @include('admins.pimpinan.include')
@endif

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Petugas Konten Reward</h1>
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
                    <h4>Data petugas konten reward</h4>
                    @if(auth()->user()->role == 'pimpinanecoranger')
                        <button data-toggle="modal" data-target="#modalCreate" class="btn btn-success fas fa-user-plus fa-2x" title="Tambahkan disini" style="margin-left: auto;"></button>
                    @endif
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
                                    <th>Aksi</th>
                                @endif
                                <th style="display:none;">id</th>
                                <th style="display:none"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($data)
                        @php $no = 1 @endphp
                        @foreach($data as $datas)
                            <tr>
                                <td class="text-center">{{$no++}}</td>
                                <td>{{$datas->nama}}</td>
                                <td>{{$datas->akun->email}}</td>
                                <td> {{$datas->nohp}}</td>
                                <td>{{$datas->alamat}}</td>
                                <td style="display:none;">{{$datas->id}}</td>
                                <td style="display:none;">{{$datas->nohp}}</td>
                                @if(auth()->user()->role == 'pimpinanecoranger')
                                <td class="text-center">

                                    <button class="edit btn btn-warning btn-sm fa fa-user-edit" title="Edit disini"></button>

                                    @if(auth()->user()->role == 'pimpinanecoranger')
                                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$datas->id}})" data-target="#DeleteModal">
                                        <button class="btn btn-danger btn-sm fa fa-user-minus" title="Hapus disini"></button>
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
                                @endif
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

    @include('admins.layouts_sidebar.datapetugaskontenreward.tambah')
    @include('admins.layouts_sidebar.datapetugaskontenreward.edit')
    

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
             $('#nohp').val(data[6]);
             $('#alamat').val(data[4]);
             
             $('#editForm').attr('action', 'datapetugaskontenreward/'+data[5]);
             $('#editModal').modal('show');
         });
 
      });
     </script>
 
 <!-- ============================ Hapus Data ========================== -->

     <script type="text/javascript">
      function deleteData(id)
      {
          var id = id;
          var url = '{{route("datapetugaskontenreward.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }
 
      function formSubmit()
      {
          $("#deleteForm").submit();
      }
   </script>
@endsection
