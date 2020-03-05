@extends('layouts_admin.admin')

@if(auth()->user()->id_role == 1)
    @include('admins.pimpinan.include')
@endif
@if(auth()->user()->id_role == 2)
    @include('admins.petugas_lapangan.include')
@endif
@if(auth()->user()->id_role == 3)
    @include('admins.komunitas.include')
@endif

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Monitoring Komunitas / Kelola Agenda</h1>
          </div>

            
              
          <div class="section-body">
          </div>
        </section>
    </div>
@endsection