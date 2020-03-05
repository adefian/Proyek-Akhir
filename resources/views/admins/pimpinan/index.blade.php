@extends('layouts_admin.admin')

@section('navbar')
    @include('admins.pimpinan.navbar')
@endsection

@section('sidebar')
    @include('admins.pimpinan.sidebar')
@endsection

@section('content')

    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                      <i class="fas fa-trash"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Jumlah Tempat Sampah</h4>
                      </div>
                      <div class="card-body">
                        10
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                      <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Jumlah Komunitas</h4>
                      </div>
                      <div class="card-body">
                        42
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                      <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Anggota</h4>
                      </div>
                      <div class="card-body">
                        1,201
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                      <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>User</h4>
                      </div>
                      <div class="card-body">
                        47
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>statistic</h4>
                    </div>
                    <div class="card-body">
                    <div class="row">
                      <div class="col-12 col-md-8 col-lg-8">
                        <div class="card">
                          <div class="card-header">
                            <h4>Bar Chart</h4>
                          </div>
                          <div class="card-body">
                            <canvas id="myChart2"></canvas>
                          </div>
                        </div>
                      </div>
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
    <script>
    "use strict";
      var ctx = document.getElementById("myChart2").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            label: 'Statistics',
            data: [460, 458, 330, 502, 430, 610, 488],
            borderWidth: 2,
            backgroundColor: '#086bc4',
            borderColor: '#086bc4',
            borderWidth: 2.5,
            pointBackgroundColor: '#ffffff',
            pointRadius: 4
          }]
        },
        options: {
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              gridLines: {
                drawBorder: false,
                color: '#f2f2f2',
              },
              ticks: {
                beginAtZero: true,
                stepSize: 150
              }
            }],
            xAxes: [{
              ticks: {
                display: false
              },
              gridLines: {
                display: false
              }
            }]
          },
        }
      });
    </script>
@endsection