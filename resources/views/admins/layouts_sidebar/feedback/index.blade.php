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
            <h1>Feedback</h1>
          </div>

          <div class="section-body">
            @if(auth()->user()->role == 'pimpinanecoranger' || auth()->user()->role == 'pimpinankomunitas')
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
                    <h4>Feedback</h4>
                  </div>
                    <div class="card-body pr-3 pl-4 m-1 table-responsive">
                        <table id="dataTable" class="table table-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Kritik & Saran</th>
                                    <th>Gambar</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                    @php $no = 1 @endphp
                                    @foreach($data as $datas)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$datas->nama}}</td>
                                            <td>{{$datas->email}}</td>
                                            <td>{{$datas->kritik_saran}}</td>
                                            <td class="align-middle">
                                            @if($datas->foto_diaplikasikan)
                                                <img height="100" id="myImg" src="{{asset('feedback')}}/{{$datas->foto_diaplikasikan}}" data-toggle="modal" data-target="#myModal"></img>
                                                @else
                                                -
                                            @endif
                                            </td>
                                            <td>{{$datas->created_at->diffForhumans()}}</td>
                                            <td class="text-center align-middle">

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
                                                @if(auth()->user()->role == 'pimpinankomunitas')
                                                    <a href="javascript:;" data-toggle="modal" onclick="deleteDatapimpinankomunitas({{$datas->id}})" data-target="#DeleteModal">
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
                        {{ method_field('POST') }}
                        <p>Apakah anda yakin ingin menghapusnya ?</p>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('js')

<!-- ============================ Hapus Data ========================== -->

     <script type="text/javascript">
      function deleteData(id)
      {
          var id = id;
          var url = '{{route("hapusfeedback", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatakomunitas(id)
      {
          var id = id;
          var url = '{{route("hapusfeedback-komunitas", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatapetugaslap(id)
      {
          var id = id;
          var url = '{{route("hapusfeedback-petugaslap", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatapimpinankom(id)
      {
          var id = id;
          var url = '{{route("hapusfeedback-pimpinankom", ":id") }}';
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