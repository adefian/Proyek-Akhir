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
@if(auth()->user()->role == 'komunitas')
    @include('admins.pimpinan_komunitas.include')
@endif

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile</h1>
          </div>

        <form action="/pimpinan-komunitas/{{$pimpinankom->id}}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
          <div class="section-body"> 
            <div class="row">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget card-primary">
                    <h2 class="section-title">Hi, {{auth()->user()->username}}!</h2>
                    <p class="section-lead">
                        Ubah informasi tentang diri Anda di halaman ini.
                    </p>
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-12 col-lg-6">
                        <div class="profile-widget-header">
                          <img alt="image" src="{{$pimpinankom->ambilFoto()}}" class="rounded-circle profile-widget-picture" style="height:130px; width:130px;">
                        </div>
                      </div>
                      <div class="col-11 col-md-11 col-lg-5">
                        <div class="form-group">
                          <label>Ganti Foto</label>
                          <input name="file_gambar" type="file" class="form-control">
                        </div>
                      </div>
                    </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name">{{$pimpinankom->nama}} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div>Pimpinan Ecoranger</div></div>
                        {{$pimpinankom->bio}}
                </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card card-primary">
                
                  {{csrf_field()}}
                  {{method_field('PATCH')}}  

                    <div class="card-header">
                      <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-7 col-12">
                            <label>Nama Lengkap</label>
                            <input name="namalengkap" type="text" class="form-control" value="{{$pimpinankom->nama}}" required="">
                            <div class="invalid-feedback">
                              Silahkan isi Nama Lengkap Anda
                            </div>
                          </div>
                          <div class="form-group col-md-5 col-12">
                            <label>Username</label>
                            <input name="username" type="text" class="form-control" value="{{$pimpinankom->pimpinan->username}}" required="">
                            <div class="invalid-feedback">
                              Silahkan isi Username Anda
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-7 col-12">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" value="{{$pimpinankom->pimpinan->email}}" required="">
                            <div class="invalid-feedback">
                              Silahkan isi Email Anda
                            </div>
                          </div>
                          <div class="form-group col-md-5 col-12">
                            <label>Ponsel</label>
                            <input name="nohp" type="tel" class="form-control" value="{{$pimpinankom->nohp}}" required="">
                            <div class="invalid-feedback">
                              Silahkan isi No Hp Anda
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-12 col-12">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Alamat</label>
                            <input name="alamat" type="text" class="form-control" value="{{$pimpinankom->alamat}}">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Bio</label>
                            <textarea name="bio" class="form-control summernote-simple" style="margin-top: 0px; margin-bottom: 0px; height: 86px;">{{$pimpinankom->bio}}</textarea>
                          </div>
                        </div>
                        
                        <div class="text-right">
                          <button class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            </div>
          </form>
        </section>
    </div>

@endsection

@section('js')
@endsection