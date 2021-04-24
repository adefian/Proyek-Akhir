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
            <h1>Manajemen / Laporan</h1>
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
                                        <h4>Laporan Agenda</h4>
                                    </div>
                                    <div class="card-body pr-3 pl-4 m-1 table-responsive">
                                        @if(auth()->user()->role == 'pimpinanecoranger')
                                        <form action="{{route('laporan.index')}}" method="get">
                                            @endif
                                            @if(auth()->user()->role == 'pimpinankomunitas')
                                            <form action="{{route('laporan-pimpinankom.index')}}" method="get">
                                                @endif

                                                <div class="form-group" style="display:inline-block">
                                                    <div class="input-group">
                                                        <select name="periode" id="periode" type="text" class="form-control">
                                                            <option value="" selected disabled>- Periode -</option>
                                                            <option value="">Semua</option>
                                                            <option value="hari" @if($periode=='hari' ) {{'selected="selected"'}} @endif>Hari ini</option>
                                                            <option value="minggu" @if($periode=='minggu' ) {{'selected="selected"'}} @endif>Minggu ini</option>
                                                            <option value="bulan" @if($periode=='bulan' ) {{'selected="selected"'}} @endif>Bulan ini</option>
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
                                                            <option value="1" @if(1==$jenis_agenda) {{'selected="selected"'}} @endif>Mendesak</option>
                                                            <option value="2" @if(2==$jenis_agenda) {{'selected="selected"'}} @endif>Penting</option>
                                                            <option value="3" @if(3==$jenis_agenda) {{'selected="selected"'}} @endif>Rutin</option>
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
                                                <button id="button" type="submit" class="btn btn-danger fa fa-print ml-3" target="_blank" name="cetakPdf" value="cetakPdf" title="Print"></button>
                                                @endif
                                            </form>


                                            <table id="dataTable" class="table table-sm" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama kegiatan</th>
                                                        <th>Komunitas</th>
                                                        <th>Keterangan</th>
                                                        <th>Gambar</th>
                                                        <th>Tanggal</th>
                                                        <th>Penanggung Jawab</th>
                                                        <th style="display:none;">id</th>
                                                        <th style="display:none;"></th>
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
                                                        <td class="text-center align-middle">
                                                            @if($datas->file_gambar)
                                                            <img height="100" id="myImg" src="{{$datas->ambilGambar()}}" data-toggle="modal" data-target="#myModal"></img>
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        <td>{{ Carbon\Carbon::parse($datas->tanggal)->isoFormat('LLLL') }} WIB</>
                                                        <td>{{$datas->petugasygmenambahkan->username}}</td>
                                                        <td style="display:none;">{{$datas->id}}</td>
                                                        <td style="display:none;">{{date("Y-m-d\TH:i",strtotime($datas->tanggal))}}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                    @elseif(auth()->user()->role == 'pimpinankomunitas')
                                                    @if($agenda)
                                                    @php $no = 1 @endphp
                                                    @foreach($agenda as $datas)
                                                    <tr>
                                                        <td class="text-center">{{$no++}}</td>
                                                        <td>{{$datas->nama}}</td>
                                                        <td>{{$datas->komunitas->daerah}}</td>
                                                        <td>{{$datas->keterangan}}</td>
                                                        <td class="text-center align-middle">
                                                            @if($datas->file_gambar)
                                                            <img height="100" id="myImg" src="{{$datas->ambilGambar()}}" data-toggle="modal" data-target="#myModal"></img>
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        <td>{{ Carbon\Carbon::parse($datas->tanggal)->isoFormat('LLLL') }}</>
                                                        <td>{{$datas->petugasygmenambahkan->username}}</td>
                                                        <td style="display:none;">{{$datas->id}}</td>
                                                        <td style="display:none;">{{date("Y-m-d\TH:i",strtotime($datas->tanggal))}}</td>
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
<!-- ========= Filter ==========  -->
<script>
    $(document).ready(function() {
        $("#periode").change(function() {

            if ($('#periode').val() !== "" || $('#periode').val() == null) {
                $("#tahun").prop("disabled", true);
            } else {
                $("#tahun").prop("disabled", false);
            }
        });
        $("#tahun").change(function() {

            if ($('#tahun').val() !== "" || $('#tahun').val() == null) {
                $("#periode").prop("disabled", true);
            } else {
                $("#periode").prop("disabled", false);
            }
        });
    });
</script>
<!-- ========= End Filter ==========  -->
@endsection