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
            @if(auth()->user()->role == 'pimpinankomunitas')
                <div class="card card-info">
            @endif
            <div class="row">
              <div class="col-12">
                  <div class="card-header">
                    <h4>Kelola Agenda</h4>
                @if(auth()->user()->role == 'pimpinanecoranger' || auth()->user()->role == 'pimpinankomunitas')
                    <button data-toggle="modal" data-target="#modalCreate" class="btn btn-success fas fa-plus fa-2x" title="Tambahkan disini" style="margin-left: auto;"></button>
                @endif
                  </div>
                <div class="card-body pr-3 pl-4 m-1 table-responsive">
                    <div class="col-12">
                        @if(auth()->user()->role == 'pimpinanecoranger')
                        <form action="{{route('kelolaagenda.index')}}" method="get">
                        @endif
                        @if(auth()->user()->role == 'pimpinankomunitas')
                        <form action="{{route('kelolaagenda-pimpinankom.index')}}" method="get">
                        @endif
                        @if(auth()->user()->role == 'komunitas')
                        <form action="{{route('kelolaagenda-komunitas.index')}}" method="get">
                        @endif
                            
                            <div class="form-group" style="display:inline-block">
                                <div class="input-group">    
                                <select name="periode" id="periode" type="text" class="form-control">
                                    <option value="" selected disabled>- Periode -</option>
                                    <option value="">Semua</option>
                                    <option value="hari" @if($periode == 'hari') {{'selected="selected"'}} @endif >Hari ini</option>
                                    <option value="minggu" @if($periode == 'minggu') {{'selected="selected"'}} @endif >Minggu ini</option>
                                    <option value="bulan" @if($periode == 'bulan') {{'selected="selected"'}} @endif>Bulan ini</option>
                                </select>
                                </div>
                            </div>
                            @if(auth()->user()->role == 'pimpinanecoranger')
                            <div class="form-group ml-3" style="display:inline-block">
                                <div class="input-group">    
                                <select name="komunitas" id="komunitas" type="text" class="form-control">
                                    <option value="" selected disabled>- Komunitas -</option>
                                    <option value="">Semua</option>
                                    @foreach($daerah as $datas)
                                        <option value="{{$datas->id}}" @if($datas->id == $kom) {{'selected="selected"'}} @endif >{{$datas->daerah}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            @endif
                            <div class="form-group ml-3" style="display:inline-block">
                                <div class="input-group">    
                                <select name="jenis_agenda" id="jenis_agenda" type="text" class="form-control">
                                    <option value="" selected disabled>- Jenis Agenda -</option>
                                    <option value="">Semua</option>
                                    <option value="1" @if(1 == $jenis_agenda) {{'selected="selected"'}} @endif >Mendesak</option>
                                    <option value="2" @if(2 == $jenis_agenda) {{'selected="selected"'}} @endif >Penting</option>
                                    <option value="3" @if(3 == $jenis_agenda) {{'selected="selected"'}} @endif >Rutin</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group ml-3" style="display:inline-block">
                                <div class="input-group">    
                                <select name="tahun" id="tahun" type="text" class="form-control">
                                    <option value="" selected disabled>- Tahun -</option>
                                    <option value="">Semua</option>
                                    @foreach($option as $datas)
                                        <option value="{{$datas->year}}" @if($datas->year == $tahun) {{'selected="selected"'}} @endif >{{$datas->year}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <button id="button" type="submit" class="btn btn-primary fa fa-filter ml-3" title="Filter"></button>
                            @if(auth()->user()->role == 'pimpinanecoranger' || auth()->user()->role == 'pimpinankomunitas')
                            <button id="button" type="submit" class="btn btn-danger fa fa-print ml-3" name="cetakPdf" value="cetakPdf" title="Print"></button>
                            @endif
                        </form>  
                    </div>

                    <table id="dataTable" class="table table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama kegiatan</th>
                                <th>Komunitas</th>
                                <th>Keterangan</th>
                                <th>Jenis Agenda</th>
                                <th>Tanggal</th>
                                <th>Penanggung Jawab</th>
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
                                            <span style="width:100%; align:center;" class="badge badge-danger">Agenda Mendesak</span>
                                        @elseif($datas->jenis_agenda == 2)
                                            <span style="width:100%; align:center;" class="badge badge-warning">Agenda Penting</span>
                                        @elseif($datas->jenis_agenda == 3)
                                            <span style="width:100%; align:center;" class="badge badge-success">Agenda Rutin</span>
                                        @endif
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($datas->tanggal)->isoFormat('LLLL') }} WIB</td>
                                        <td>{{$datas->petugasygmenambahkan->username}}</td>
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
                        @elseif(auth()->user()->role == 'komunitas' || auth()->user()->role == 'pimpinankomunitas')
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
                                            <span style="width:100%; align:center;" class="badge badge-danger">Agenda Mendesak</span>
                                        @elseif($kom->jenis_agenda == 2)
                                            <span style="width:100%; align:center;" class="badge badge-warning">Agenda Penting</span>
                                        @elseif($kom->jenis_agenda == 3)
                                            <span style="width:100%; align:center;" class="badge badge-success">Agenda Rutin</span>
                                        @endif
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($kom->tanggal)->isoFormat('LLLL') }}</td>
                                        <td>{{$kom->petugasygmenambahkan->username}}</td>
                                        <td style="display:none;">{{$kom->id}}</td>
                                        <td class="text-center">

                                            <button class="edit btn btn-warning btn-sm fa fa-edit" title="Edit disini"></button>

                                            @if(auth()->user()->role == 'pimpinankomunitas')
                                                <a href="javascript:;" data-toggle="modal" onclick="deleteDatapimpinankom({{$kom->id}})" data-target="#DeleteModal">
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

<!-- ========= Filter ==========  -->
    <script>
        $(document).ready(function () {
            $("#periode").change(function(){

                if ($('#periode').val() !== "" || $('#periode').val() == null) {
                    $("#tahun").prop("disabled",true);
                } else{
                    $("#tahun").prop("disabled",false);
                }
            });
            $("#tahun").change(function(){

                if ($('#tahun').val() !== "" || $('#tahun').val() == null) {
                    $("#periode").prop("disabled",true);
                } else{
                    $("#periode").prop("disabled",false);
                }
            });
        });
    </script>
<!-- ========= End Filter ==========  -->

<!-- ========= Fungsi JS dalam Modal ==========  -->
   <script>
        $(document).ready(function () {
            $("#jenisagenda").change(function(){

                if ($('#jenisagenda').val() == "3") {
                    $('#pemberitahuan').html('Pilih hari dan tanggal untuk memulai Agenda rutin selama 4 minggu ke depan ').css('color', 'green');
                } else{
                    $('#pemberitahuan').html('').css('color', 'red');
                }

                if($('#jenisagenda').val() == "1") {
                    document.getElementById('tanggal-max').setAttribute("max", "{{Carbon\Carbon::now()->addDays(1)->format('Y-m-d\TH:i')}}");
                }else{
                    $('#tanggal-max').removeAttr("max");
                }
            });
        });
   </script>     
<!-- ========= End Fungsi JS dalam Modal ==========  -->

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

             var element = document.getElementById('jenis_ag');
             element.innerHTML = data[4];
             
             $('#editForm').attr('action', 'kelolaagenda/'+data[7]);
             $('#editFormpimpinankom').attr('action', 'kelolaagenda-pimpinankom/'+data[7]);
             $('#editFormkomunitas').attr('action', 'kelolaagenda-komunitas/'+data[7]);
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
          var url = '{{route("kelolaagenda.destroy", ":id") }}';
          url = url.replace(':id', id);
          $("#deleteForm").attr('action', url);
      }

      function deleteDatapimpinankom(id)
      {
          var id = id;
          var url = '{{route("kelolaagenda-komunitas.destroy", ":id") }}';
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