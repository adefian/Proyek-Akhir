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
            <h1>Monitoring Tempat Sampah Pintar / Indikasi</h1>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Header</h4>
                    </div>
                    <div class="card-body">
                    <div class="row">
                      <div class="col-12 col-md-8 col-lg-8">
                        <div class="card">
                          <div class="card-header">
                            <h4>Header</h4>
                          </div>
                          <div class="card-body">
                            <h4>Body</h4>
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