@extends('layouts_admin.admin')

@include('admins.pimpinan.include')

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile</h1>
          </div>

          <form action="{{route('pimpinan.update', [$pimpinan->id])}}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
            <div class="section-body"> 
              <div class="row">
                <div class="col-12 col-md-12 col-lg-5">
                  <div class="card profile-widget card-primary">
                      <h2 class="section-title">Hi, {{auth()->user()->username}}!</h2>
                      <p class="section-lead"></p>
                      <div class="row justify-content-center">
                        <div class="col-6 col-md-8 col-lg-6">
                          <div class="profile-widget-header" style="margin-top:-20px; margin-bottom:-20px margin-left:40px">
                            <img alt="image" src="{{$pimpinan->ambilFoto()}}" class="rounded-circle profile-widget-picture align-center" style="height:150px; width:150px;">
                          </div>
                        </div>
                        <div class="profile-widget-description">
                          <div class="profile-widget-name">{{$pimpinan->nama}} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div>Pimpinan Ecoranger</div></div>
                          {{$pimpinan->bio}}                          
                        </div>
                        <div class="col-11 col-md-11 col-lg-5">
                          <div class="form-group">
                            <label>Ganti Foto</label>
                            <input name="file_gambar" type="file" id="image" class="form-control">
                            <div class="mt-3" id="upload-demo"></div>
                          </div>
                        </div>
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
                              <input name="namalengkap" type="text" class="form-control" value="{{$pimpinan->nama}}" required="">
                              <div class="invalid-feedback">
                                Silahkan isi Nama Lengkap Anda
                              </div>
                            </div>
                            <div class="form-group col-md-5 col-12">
                              <label>Username</label>
                              <input name="username" type="text" class="form-control" value="{{$pimpinan->pimpinan->username}}" required="">
                              <div class="invalid-feedback">
                                Silahkan isi Username Anda
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-7 col-12">
                              <label>Email</label>
                              <input name="email" type="email" class="form-control" value="{{$pimpinan->pimpinan->email}}" required="">
                              <div class="invalid-feedback">
                                Silahkan isi Email Anda
                              </div>
                            </div>
                            <div class="form-group col-md-5 col-12">
                              <label>Ponsel</label>
                              <input name="nohp" type="tel" class="form-control" value="{{$pimpinan->nohp}}" required="">
                              <div class="invalid-feedback">
                                Silahkan isi No Hp Anda
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-12 col-12">
                              <label>Password</label>
                              <input name="password" type="password" class="form-control">
                              <small class="text-danger">Isi form diatas jika ingin mengganti password</small>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                              <label>Alamat</label>
                              <input name="alamat" type="text" class="form-control" value="{{$pimpinan->alamat}}">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                              <label>Bio</label>
                              <textarea name="bio" class="form-control summernote-simple" style="margin-top: 0px; margin-bottom: 0px; height: 86px;">{{$pimpinan->bio}}</textarea>
                            </div>
                          </div>
                          
                          <div class="text-right">
                            <button class="btn btn-primary" id="upload-image">Simpan Perubahan</button>
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
<!-- <script>
  $( document ).ready(function() {
  var resize = $('#upload-demo').croppie({

    enableExif: true,

    enableOrientation: true,    

    viewport: { 

        width: 150,

        height: 150,

        type: 'circle'

    },

    boundary: {

        width: 200,

        height: 200

    }

  });
  $('#image').on('change', function () { 

  var reader = new FileReader();

    reader.onload = function (e) {

      resize.croppie('bind',{

        url: e.target.result

      }).then(function(){

        console.log('jQuery bind complete');

      });

    }

    reader.readAsDataURL(this.files[0]);

  });
  $('.upload-image').on('click', function (e) {

    var image_data = rezise.croppie('result', 'base64');
        if (image_data != '') {
            var formData = $('#image').serialize();
            $.ajax({
                type: "POST",
                url: "uploadUrl",
                data: formData, 
                cache: false,
                success: function (data)
                {
                  swal('jj');
                }
            });
        } else {
          swal('Gagal Memperbarui Foto');
        }
      });
    });
  });
</script> -->
@endsection