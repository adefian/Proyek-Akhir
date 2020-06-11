@extends('layouts_admin.admin')

@section('navbar')
    @include('admins.petugas_lapangan.navbar')
@endsection

@section('sidebar')
    @include('admins.petugas_lapangan.sidebar')
@endsection

@section('content')

    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>

          <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1 card-success">
                    <div class="card-icon bg-success">
                      <i class="fas fa-box-open"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Data Sampah Masuk</h4>
                      </div>
                      <div class="card-body">
                        {{$sampah}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1 card-warning">
                    <div class="card-icon bg-warning">
                      <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Petugas Lapangan</h4>
                      </div>
                      <div class="card-body">
                        {{$petugaslapangan}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1 card-danger">
                    <div class="card-icon bg-danger">
                      <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Sampah Penuh</h4>
                      </div>
                      <div class="card-body">
                        {{$sampahpenuh}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1 card-primary">
                    <div class="card-icon bg-primary">
                      <i class="fas fa-dumpster"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Tempat Sampah</h4>
                      </div>
                      <div class="card-body">
                        {{$tempatsampah}}
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

@section('js')

    <script src="{{asset('js/Chart.min.js')}}"></script>
    <!-- <script src="{{asset('assets/stisla/js/page/modules-chartjs.js')}}"></script> -->
    
@endsection