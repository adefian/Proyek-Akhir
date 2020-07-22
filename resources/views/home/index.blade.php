@extends('home.landingpage')

@section('css')

    <link rel="stylesheet" href="{{asset('assets/fullcalendar/packages/core/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fullcalendar/packages/daygrid/main.css')}}">
    <style>
      #map {
        height:450px;
      };
      #mapkomunitas {
        height:450px;
      };
      #calendar {
        max-width: 900px;
        margin: 0 auto;
      }
    </style>


@endsection

@section('navbar')
    @include('home.include.navbar')
@endsection

@section('hero')
    @include('home.include.hero')
@endsection

@section('content')

 <!-- ======= Agenda ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Kalender</h2>
          <p>Agenda dari Komunitas</p>
        </div>

        <div class="row" data-aos="fade-left">
          <div class="col-12">
            <!-- <div class="response">{{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y')}}</div> -->
              <div class="mb-5" id="calendar"></div>
              <!-- <table class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama kegiatan</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Komunitas</th>
                    </tr>
                </thead>
                <tbody>
                    @if($agenda)
                        @php $no = 1 @endphp
                        @foreach($agenda as $agendas)
                            <tr>
                                <td class="text-center">{{$no++}}</td>
                                <td>{{$agendas->nama}}</td>
                                <td>{{$agendas->keterangan}}</td>
                                <td>{{ Carbon\Carbon::parse($agendas->tanggal)->isoFormat('LLLL') }} WIB</td>
                                <td>{{$agendas->komunitas->daerah}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-right">
                        {{ $agenda->links() }}
            </div> -->
          </div>
        </div>

      </div>
    </section>
<!-- End Agenda -->

<!-- ======= map ======= -->
    <section id="details" class="details">
      <div class="container">

        <div class="row content" style="margin-top:-50px; margin-bottom:-40px;">
          <div class="col-md-6 mb-4" data-aos="fade-up">
            <h3 class="text-center mb-3">Tempat Sampah Pintar <img src="{{asset('assets-landingpage/img/marker_ts2.png')}}"/></h3>
            <p class="font-italic">
              Daftar Tempat Sampah Pintar yang sudah ada di wilayah Kabupaten Banyuwangi
            </p>
            <ul>
              @if($tempatsampah)
              @foreach($tempatsampah as $tempatsampahs)
              <li><i class="icofont-check"></i> {{$tempatsampahs->nama}}</li>
              @endforeach
              @endif
            </ul>
            <p>
              Tempat Sampah Pintar ini dapat menjadikan bahan edukasi bagi masyarakat, agar membuang sampah dengan tepat sesuai kategorinya.
            </p>
          </div>
          <div class="col-md-6 order-2 order-md-1" data-aos="fade-up">
            <h3>Daftar Komunitas   <img src="{{asset('assets-landingpage/img/marker_km2.png')}}"/></h3>
            <p class="font-italic">
              Daftar yang tergabung dalam Komunitas Ecoranger sesuai dengan daerahnya masing-masing 
            </p>
            <ul>
              @if($komunitas)
              @foreach($komunitas as $komunitass)
              <li><i class="icofont-check"></i> {{$komunitass->daerah}}</li>
              @endforeach
              @endif
            </ul>
            <p>
              Komunitas ini Tergabung dalam Komunitas EcoRanger yang menaungi setiap daerahnya masing-masing. 
            </p>
          </div>
        </div>
        
        <div class="row content">
          <div class="col-md-12" data-aos="fade-right">
            <div id="map" style="border-radius: 15px;" class="shadow"></div>
          </div>
        </div>

      </div>
    </section><!-- End map -->

<!-- ============= Array ============= -->
<!-- ============= Feedback ============= -->
<section id="contact" class="contact">
      <div class="container">

        <div class="section-title aos-init aos-animate" data-aos="fade-up">
          <h2>Kritik & Saran</h2>
          <p>Feedback</p>
        </div>

        <div class="row justify-content-center">

          <div class="col-lg-10 mt-5 mt-lg-0 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">

            <form action="{{route('kirimfeedback')}}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="nama" class="form-control" id="name" placeholder="Nama Anda"  required>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda" required>
                </div>
              </div>
              <div class="form-group">
                <input type="file" class="form-control" name="file_gambar" id="subject" required>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="kritik_saran" rows="5" placeholder="Masukkan Usulan Anda" required></textarea>
              </div>
            
              <div class="text-center"><button class="btn btn-primary" style="width:100%" type="submit">Kirim</button></div>
            </form>

          </div>

        </div>

      </div>
    </section>
<!-- ============= End Feedback ============= -->

<!-- ======= Team Section ======= -->
  <!-- <section id="team" class="team">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2></h2>
          <p></p>
        </div>

        <div class="row" data-aos="fade-left">

          <div class="col-lg-4 col-md-6">
            <div class="member" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="{{asset('assets-landingpage/img/team/team-1.jpg')}}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Haris Abdul Azis</h4>
                <span>Chief Executive Officer</span>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
            <div class="member" data-aos="zoom-in" data-aos-delay="200">
              <div class="pic"><img src="{{asset('assets-landingpage/img/team/team-2.jpg')}}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Khoirul Anam</h4>
                <span>Product Manager</span>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
            <div class="member" data-aos="zoom-in" data-aos-delay="300">
              <div class="pic"><img src="{{asset('assets-landingpage/img/team/team-3.jpg')}}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Ade Fian Galih I</h4>
                <span>CTO</span>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section> -->
<!-- End Team Section -->

<!-- ======= Testimonials Section ======= -->
  <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="owl-carousel testimonials-carousel" data-aos="zoom-in">
        
        @if($pimpinan)
          @foreach($pimpinan as $data)
          <div class="testimonial-item">
            <img src="{{$data->ambilFoto()}}" style="height:100px; width:100px;" class="testimonial-img" alt="image">
            <h3>{{$data->nama}}</h3>
            <h4>Pimpinan EcoRanger</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                {{$data->bio}}
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
          @endforeach
        @endif
        @if($pimpinankom)
          @foreach($pimpinankom as $data)
          <div class="testimonial-item">
            <img src="{{$data->ambilFoto()}}" style="height:100px; width:100px;" class="testimonial-img" alt="image">
            <h3>{{$data->nama}}</h3>
            <h4>Pimpinan Komunitas {{$data->daerahygdipilih->daerah}}</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                {{$data->bio}}
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
          @endforeach
        @endif
        @if($anggota_komunitas)
          @foreach($anggota_komunitas as $data)
          <div class="testimonial-item">
            <img src="{{$data->ambilFoto()}}" style="height:100px; width:100px;" class="testimonial-img" alt="image">
            <h3>{{$data->nama}}</h3>
            <h4>Anggota Komunitas {{$data->daerahygdipilih->daerah}}</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                {{$data->bio}}
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
          @endforeach
        @endif
        @if($petugaslap)
          @foreach($petugaslap as $data)
          <div class="testimonial-item">
            <img src="{{$data->ambilFoto()}}" style="height:100px; width:100px;" class="testimonial-img" alt="image">
            <h3>{{$data->nama}}</h3>
            <h4>Petugas Lapangan {{$data->wilayah}}</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                {{$data->bio}}
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
          @endforeach
        @endif
        @if($petugaskonten)
          @foreach($petugaskonten as $data)
          <div class="testimonial-item">
            <img src="{{$data->ambilFoto()}}" style="height:100px; width:100px;" class="testimonial-img" alt="image">
            <h3>{{$data->nama}}</h3>
            <h4>Petugas Konten Reward</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                {{$data->bio}}
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
          @endforeach
        @endif

        </div>

      </div>
    </section><!-- End Testimonials Section -->




    <script>
      var array =[];
      var array2 = [];
    </script>

    @foreach ($tempatsampah as $tempatsampahs)

    <script type="text/javascript">

        //Memasukkan data tabel tempat sampah ke array
        array.push(['<?php echo $tempatsampahs->nama?>','<?php echo $tempatsampahs->latitude?>','<?php echo $tempatsampahs->longitude?>','<?php echo $tempatsampahs->petugasygmenambahkan->username?>','<?php echo $tempatsampahs->file_gambar ?>']);

    </script> 

    @endforeach

    @foreach ($komunitas as $komunitass)

    <script type="text/javascript">

        //Memasukkan data tabel komunitas ke array
        array2.push(['<?php echo $komunitass->latitude?>','<?php echo $komunitass->longitude?>','<?php echo $komunitass->daerah?>','<?php echo $komunitass->keterangan?>','<?php echo $komunitass->email ?>']);

    </script> 

    @endforeach
  
<!-- ============= Array ============= -->

@endsection

@section('js')

    <script src="{{asset('assets/fullcalendar/packages/core/main.js')}}"></script>
    <script src="{{asset('assets/fullcalendar/packages/interaction/main.js')}}"></script>
    <script src="{{asset('assets/fullcalendar/packages/daygrid/main.js')}}"></script>
    <script src="{{asset('assets/fullcalendar/packages/core/locale-all.js')}}"></script>
    <script src="{{ asset('assets/fullcalendar/packages/core/locales/id.js')}}"></script>

<!-- ============================ Maps ===================== -->

  <script>
      
      function initMap() {

        var bounds = new google.maps.LatLngBounds();

        var peta = new google.maps.Map(document.getElementById("map"), {
          center : {lat: -8.408698, lng: 114.2339090},
          zoom : 9.5
        });

        var infoWindow = new google.maps.InfoWindow(), marker, i;

        for (var i = 0; i < array.length; i++) {
          
          var position = new google.maps.LatLng(array[i][1],array[i][2]);

          bounds.extend(position);

          var marker = new google.maps.Marker({

            position : position,
            map : peta,
            icon : '{{asset('assets-landingpage/img/marker_ts.png')}}',
            title : array[i][0]
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {

            return function() {

              var infoWindowContent = 
              '<div class="content"><p>'+
              '<h6>'+array[i][0]+'</h6>'+
              '<img height="130" style="margin:0 auto; display:block;" src="assets/img/tempatsampah/'+array[i][4]+'"/><br/>'+
              'Penanggung Jawab : '+array[i][3]+'<br/>'+
              'Titik Koordinat : '+array[i][1]+', '+array[i][2]+'<br/>'+
              '</p></div>';

              infoWindow.setContent(infoWindowContent);

              infoWindow.open(peta, marker);
            }

          })(marker, i));
        }
    //

        var infoWindow2 = new google.maps.InfoWindow(), marker2, a;

            for (var a = 0; a < array2.length; a++) {
              
              var position2 = new google.maps.LatLng(array2[a][0],array2[a][1]);

              bounds.extend(position2);

              var marker2 = new google.maps.Marker({

                position : position2,
                map : peta,
                icon : '{{asset('assets-landingpage/img/marker_km.png')}}',
                title : array2[a][2]
              });

              google.maps.event.addListener(marker2, 'click', (function(marker2, a) {

                return function() {

                  var infoWindowContent2 = 
                  '<div class="content">'+
                  '<h6>'+array2[a][2]+'</h6>'+
                  '<p>Titik Koordinat : '+array2[a][0]+', '+array2[a][1]+'<br/>'+
                  'Daerah : '+array2[a][2]+'<br/>'+
                  'Keterangan : '+array2[a][3]+'<br/>'+
                  'Email Penanggung Jawab : '+array2[a][4]+'</p>'+

                  '</div>';

                  infoWindow2.setContent(infoWindowContent2);

                  infoWindow2.open(peta, marker2);
                }

              })(marker2, a));
            }
      
      }
      
    </script>
<!-- ============================ End Maps ===================== -->

<!-- ============================ Kalender ===================== -->
    
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      lang: 'id',
      plugins: [ 'interaction', 'dayGrid' ],
      eventClick: function(info) {
      var eventObj = info.event;

      if (eventObj.url) {
          swal(
            'Clicked ' + eventObj.title + '.\n' +
            'Will open ' + eventObj.url + ' in a new tab'
          );

          window.open(eventObj.url);

          info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
        } else {
          swal('Agenda ' + eventObj.title + '\n'+
            eventObj.classNames + '\n' + eventObj.start
          );
          info.el.style.borderColor = 'black';
        }
      },
      height: 500,
      header: {
        start: 'title',
        center: '',
        right: 'prev,next,dayGridMonth,today'
      },
      defaultDate: {!! json_encode($tgl) !!},
      navLinks: true, 
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: {!! json_encode($listagenda) !!},
    });

    calendar.render();
  });

</script>
<!-- ============================ End Kalender ===================== -->

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initMap" type="text/javascript"></script>


@endsection
