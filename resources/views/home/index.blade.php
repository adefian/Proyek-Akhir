@extends('home.landingpage')

@section('css')
    <style>
      #map {height:450px;};
      #mapkomunitas {height:450px;};
    </style>

    <style href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.css"></style>
    <style href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css"></style>
    <style href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css"></style>
    <style href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/list/main.min.css"></style>
    <style href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.css"></style>
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
            <div id="kalender"></div>
            <table class="table table-responsive" style="width:100%">
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
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama kegiatan</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Komunitas</th>
                            </tr>
                        </tfoot>
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
            <h3 class="text-center mb-3">Tempat Sampah Pintar <img src="https://img.icons8.com/plasticine/50/000000/order-shipped.png"/></h3>
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
            <h3>Daftar Komunitas <img src="https://img.icons8.com/plasticine/50/000000/marker.png"/></h3>
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
           icon : 'https://img.icons8.com/plasticine/40/000000/order-shipped.png',
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
                icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
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
    $('#kalender').fullCalendar({
        defaultView: 'month',
        defaultDate: '2018-11-12',

        eventRender: function (eventObj, $el) {
            $el.popover({
                title: eventObj.title,
                content: eventObj.description,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },

        events: [{
                title: 'All Day Event',
                description: 'description for All Day Event',
                start: '2018-11-01'
            },
            {
                title: 'Long Event',
                description: 'description for Long Event',
                start: '2018-10-07',
                end: '2018-11-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                description: 'description for Repeating Event',
                start: '2018-11-09T16:00:00'
            },
            {
                id: 999,
                title: 'Repeating Event',
                description: 'description for Repeating Event',
                start: '2018-11-16T16:00:00'
            },
            {
                title: 'Conference',
                description: 'description for Conference',
                start: '2018-11-11',
                end: '2018-11-13'
            },
            {
                title: 'Meeting',
                description: 'description for Meeting',
                start: '2018-11-12T10:30:00',
                end: '2018-11-12T12:30:00'
            },
            {
                title: 'Lunch',
                description: 'description for Lunch',
                start: '2018-11-12T12:00:00'
            },
            {
                title: 'Meeting',
                description: 'description for Meeting',
                start: '2018-11-12T14:30:00'
            },
            {
                title: 'Birthday Party',
                description: 'description for Birthday Party',
                start: '2018-11-13T07:00:00'
            },
            {
                title: 'Click for Google',
                description: 'description for Click for Google',
                url: 'http://google.com/',
                start: '2018-11-28'
            }
        ]
    });
    </script>
<!-- ============================ End Kalender ===================== -->


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-h2II7DbFQkpL9pDxNRq3GWXqS5Epts&callback=initMap" type="text/javascript"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/google-calendar/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/interaction/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/list/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/luxon/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/moment-timezone/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/moment/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/rrule/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.js"></script>

@endsection
