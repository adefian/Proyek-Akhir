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
            <h1>Daftar Poin Terbesar</h1>
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
                    <h4>Data Pembuang Sampah Dengan Poin Tertinggi</h4>
                  </div>
                    <div class="card-body pr-3 pl-4 m-1 table-responsive">        
                    @if(auth()->user()->role == 'pimpinanecoranger')
                    <a href="{{route('riwayatpembuangan.index')}}"><button class="btn btn-primary mb-3">Riwayat Pembuangan Sampah</button></a>
                    @elseif(auth()->user()->role == 'petugaslapangan')
                    <a href="{{route('riwayatpembuangan-petugaslap.index')}}"><button class="btn btn-success mb-3">Riwayat Pembuangan Sampah</button></a>
                    @endif

                    @if(auth()->user()->role == 'petugaslapangan' || auth()->user()->role == 'pimpinanecoranger')
                      <div class="col-12">
                        @if(auth()->user()->role == 'pimpinanecoranger')
                        <form action="{{route('poin')}}" method="get">
                        @endif
                        @if(auth()->user()->role == 'petugaslapangan')
                        <form action="{{route('poin-petugaslap')}}" method="get">
                        @endif
                            <div class="form-group" style="display:inline-block">
                                <div class="input-group">    
                                <select name="list" type="text" class="form-control">
                                        <option value="" selected disabled>- Daftar -</option>
                                        <option value="">Semua</option>
                                        <option value="10" @if($list == '10') {{'selected="selected"'}} @endif >10 Besar</option>
                                        <option value="20" @if($list == '20') {{'selected="selected"'}} @endif >20 Besar</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group ml-3" style="display:inline-block">
                                <div class="input-group">    
                                <select name="periode" type="text" class="form-control">
                                    <option value="" selected disabled>- Periode -</option>
                                    <option value="">Semua</option>
                                    <option value="hari" @if($periode == 'hari') {{'selected="selected"'}} @endif >Hari ini</option>
                                    <option value="minggu" @if($periode == 'minggu') {{'selected="selected"'}} @endif >Minggu ini</option>
                                    <option value="bulan" @if($periode == 'bulan') {{'selected="selected"'}} @endif >Bulan ini</option>
                                    <option value="tahun" @if($periode == 'tahun') {{'selected="selected"'}} @endif >Tahun ini</option>
                                </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary fa fa-filter ml-3" title="Filter"></button>
                            <button type="submit" class="btn btn-danger fa fa-print ml-3" name="cetakPdf" value="cetakPdf" title="Print"></button>
                        </form>  
                        </div>
                    @endif
                        <table id="dataTable" class="table table-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">No Hp</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Total Poin</th>
                                    <th class="text-center">Penambahan Poin Terakhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                    @php $no = 1 @endphp
                                    @foreach($data as $datas)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td>{{$datas->nama}}</td>
                                            <td class="text-center"> {{$datas->nohp}}</td>
                                            <td class="text-center">{{$datas->alamat}}</td>
                                            <td class="text-center">{{$datas->total_poin}}</td>
                                            <td class="text-center">{{$datas->updated_at->diffForHumans()}}</td>
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