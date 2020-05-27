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
            <h1>Daftar Sampah Masuk</h1>
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
            
              
          <div class="section-body">
          </div>
        </section>
    </div>
@endsection