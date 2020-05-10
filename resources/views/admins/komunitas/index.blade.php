@extends('layouts_admin.admin')

@section('navbar')
    @include('admins.komunitas.navbar')
@endsection

@section('sidebar')
    @include('admins.komunitas.sidebar')
@endsection

@section('content')

    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>

            <div class="row">
                <div class="col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                      <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-body" style="padding:31px">
                        <h5>Anggota dari Komunitas {{$namakomunitas->daerahygdipilih->daerah}}</h5>
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
                        <h4>Agenda Komunitas</h4>
                      </div>
                      <div class="card-body">
                        {{$agenda}}
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
                        <h4>Komunitas</h4>
                      </div>
                      <div class="card-body">
                        {{$komunitas}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1 card-warning">
                    <div class="card-icon bg-warning">
                      <i class="fas fa-id-badge"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Anggota Komunitas</h4>
                      </div>
                      <div class="card-body">
                        {{$anggotakomunitas}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1 card-success">
                    <div class="card-icon bg-success">
                      <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Saran Ecobrick</h4>
                      </div>
                      <div class="card-body">
                        {{$ecobrick}}
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