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

 <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Kalender</h2>
          <p>Agenda dari Komunitas</p>
        </div>

        <div class="row" data-aos="fade-left">
          <div class="col-12">
            <div class="response"></div>
              <div id="calendar"></div>
              <table class="table table-hover" style="width:100%">
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
          </div>
        </div>

      </div>
    </section>
<!-- End Features Section -->

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
              <li><i class="icofont-check"></i> {{$tempatsampahs->namalokasi}}</li>
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
              Daftar yang tergabung dalam komunitas Ecoranger sesuai dengan daerahnya masing-masing 
            </p>
            <ul>
             @if($komunitas)
              @foreach($komunitas as $komunitass)
              <li><i class="icofont-check"></i> {{$komunitass->daerah}}</li>
              @endforeach
             @endif
            </ul>
            <p>
              Inventore id enim dolor dicta qui et magni molestiae. Mollitia optio officia illum ut cupiditate eos autem. Soluta dolorum repellendus repellat amet autem rerum illum in. Quibusdam occaecati est nisi esse. Saepe aut dignissimos distinctio id enim.
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

            <form action="kirimfeedback" method="POST" enctype="multipart/form-data">
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
                <input type="file" class="form-control" name="gambar" id="subject">
              </div>
              <div class="form-group">
                <textarea class="form-control" name="usulan" rows="5" placeholder="Masukkan Usulan Anda" required></textarea>
              </div>
            
              <div class="text-center"><button class="btn btn-primary" style="width:100%" type="submit">Kirim</button></div>
            </form>

          </div>

        </div>

      </div>
    </section>
<!-- ============= End Feedback ============= -->


    <script>
      var array =[];
      var array2 = [];
    </script>

    @foreach ($tempatsampah as $tempatsampahs)

    <script type="text/javascript">

        //Memasukkan data tabel tempat sampah ke array
        array.push(['<?php echo $tempatsampahs->namalokasi?>','<?php echo $tempatsampahs->latitude?>','<?php echo $tempatsampahs->longitude?>','<?php echo $tempatsampahs->petugasygmenambahkan->nama?>','<?php echo $tempatsampahs->foto ?>']);

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
             'Petugas yang Menambahkan : '+array[i][3]+'<br/>'+
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
                  'Email yang menambahkan : '+array2[a][4]+'</p>'+

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
      plugins: [ 'interaction', 'dayGrid' ],
      header: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      defaultDate: {!! json_encode($tgl) !!},
      navLinks: true, // can click day/week names to navigate views
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
