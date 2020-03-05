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

            
              
          <div class="section-body">
          </div>
        </section>
    </div>

@endsection

@section('js')

    <script src="{{asset('js/Chart.min.js')}}"></script>
    <!-- <script src="{{asset('assets/stisla/js/page/modules-chartjs.js')}}"></script> -->
    
@endsection