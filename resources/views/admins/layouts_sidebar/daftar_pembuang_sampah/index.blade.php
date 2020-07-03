@extends('layouts_admin.admin')

@if(auth()->user()->role == 'pimpinanecoranger' || auth()->user()->role == 'pimpinankomunitas')
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
            <h1>Riwayat Pembuang Sampah</h1>
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
            @if(auth()->user()->role == 'pimpinankom')
                <div class="card card-info">
            @endif
            <div class="row">
              <div class="col-12">
                  <div class="card-header">
                    <h4>Data Pembuang Sampah</h4>
                  </div>
                    <div class="card-body pr-3 pl-4 m-1 table-responsive">
                    @if(auth()->user()->role == 'pimpinanecoranger')
                    <a href="/poin"><button class="btn btn-primary mb-3">Poin Terbesar</button></a>
                    @elseif(auth()->user()->role == 'petugaslapangan')
                    <a href="/poin-petugaslap"><button class="btn btn-success mb-3">Poin Terbesar</button></a>
                    @endif
                        <table id="dataTable" class="table table-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Poin</th>
                                    <th class="text-center">Dari Tempat Sampah</th>
                                    <th class="text-center">Pada</th>
                                    <th class="text-center">Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                    @php $no = 1 @endphp
                                    @foreach($data as $datas)
                                        <tr>
                                            <td class="text-center align-middle">{{$no++}}</td>
                                            <td class="align-middle">
                                            @if($datas->status == 1)
                                                <span style="width:100%; align:center;" class="badge badge-success">Benar</span>
                                                @else
                                                <span style="width:100%; align:center;" class="badge badge-danger">Salah</span>
                                            @endif
                                            </td>
                                            <td class="text-center align-middle">{{$datas->nilai}}</td>
                                            <td class="text-center">{{$datas->dari_tempatsampah->nama}}</td>
                                            <td class="text-center">{{$datas->created_at->diffForHumans()}}</td>
                                            @if($datas->masyarakat_id === null)
                                            <td class="text-center">-</td>
                                            @else
                                            <td class="text-center">{{$datas->oleh->nama}}</td>
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
            
              
          <div class="section-body">
          </div>
        </section>
    </div>
@endsection