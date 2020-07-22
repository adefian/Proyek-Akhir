@extends('home.landingpage')

@section('navbar')
<nav class="nav-menu d-none d-lg-block">
  <ul>
    <li class="active"><a href="#header">Ecobrick</a></li>
    <li><a href="#about">Tentang Ecobrick</a></li>
    <li><a href="#gallery">Gambar</a></li>
    <li><a href="{{route('home')}}">Beranda</a></li>
    @if (Route::has('login'))
    @auth
    @if(Auth()->user()->role == 'pimpinanecoranger')
    <li><a href="{{route('pimpinan.index')}}">Masuk</a></li>
    @elseif(Auth()->user()->role == 'pimpinankomunitas')
    <li><a href="{{route('pimpinan-komunitas.index')}}">Masuk</a></li>
    @elseif(Auth()->user()->role == 'komunitas')
    <li><a href="{{route('komunitas.index')}}">Masuk</a></li>
    @elseif(Auth()->user()->role == 'petugaslapangan')
    <li><a href="{{route('petugaslapangan.index')}}">Masuk</a></li>
    @endif
    @else
    <li class="drop-down"><a>Akun</a>
      <ul>
        <li><a href="{{route('login')}}">Login</a></li>
        @if (Route::has('register'))
        <li><a href="{{route('register') }}">Daftar Sebagai </br> Anggota Komunitas</a></li>
        @endif
      </ul>
    </li>
    @endauth
    @endif
  </ul>
</nav><!-- .nav-menu -->
@endsection

@section('hero')
<div class="container">
  <div class="row">
    <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
      <div data-aos="zoom-out">
        <h1>Manfaatkan Sampah Sebagai <span>Ecobrick</span></h1>
        <h2>Selamatkan bumi dengan mengurangi Sampah</h2>
        <div class="text-center text-lg-left">
          <a href="#about" class="btn-get-started scrollto">Mulai</a>
        </div>
      </div>
    </div>
    <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
      <img src="{{asset('assets-landingpage/img/2youzhang.png')}}" class="img-fluid animated" style="border-radius: 20px;" alt="">
    </div>
  </div>
</div>
@endsection

@section('content')
<!-- ======= About Section ======= -->
<section id="about" class="about">
  <div class="container-fluid">

    <div class="row justify-content-center">
      <div class="col-xl-5 video-box d-flex justify-content-center align-items-stretch" data-aos="fade-right">
        <a href="https://www.youtube.com/watch?v=xUXLFtdsptA" class="venobox play-btn mb-4 mr-2" data-vbtype="video" data-autoplay="true"></a>
      </div>
      <div class="col-xl-5 video-box2 d-flex justify-content-center align-items-stretch" data-aos="fade-right">
        <a href="https://www.youtube.com/watch?v=lLDULY6eQng" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
      </div>

      <div class="col-xl-11 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
        <h3>Ecobricks </h3>
        <p>Dari namanya yang menarik dan unik, banyak dari kalian yang bertanya-tanya apa Ecobrick itu. Eco dan Brick? Bagaimana kedua kata itu bisa digabungkan? Apa manfaatnya? </p>
        <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon"><i class="bx bx-fingerprint"></i></div>
          <h4 class="title"><a href="">Apasih Ecobrick ?</a></h4>
          <p class="description">“Eco” dan “brick” artinya bata ramah lingkungan. Disebut “bata” karena ia dapat menjadi alternatif bagi bata konvensional dalam mendirikan bangunan. Maka dari itu ecobrick biasa dimanfaatkan sebagai bahan baku pembuatan furniture. Ecobrick adalah botol plastik yang diisi padat dengan limbah non-biological untuk membuat blok bangunan yang dapat digunakan kembali.</p>
        </div>

        <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
          <div class="icon"><i class="bx bx-gift"></i></div>
          <h4 class="title"><a href="">Manfaat</a></h4>
          <p class="description">Dengan ecobrick, sampah-sampah plastik ini akan tersimpan terjaga di dalam botol sehingga tidak perlu dibakar, menggunung, tertimbun dan lain-lain. Teknologi ecobrick memungkinkan kita untuk tidak menjadikan plastik di salah satu industrial recycle system, dengan begitu akan menjauhi biosfer dan menghemat energi. Ecobrick menjaga bahan-bahan plastik tersebut melepaskan CO2 yang pada akhirnya akan menyumbang pemanasan global.</p>
        </div>

        <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
          <div class="icon"><i class="bx bx-atom"></i></div>
          <h4 class="title"><a href="">Cara Membuatnya</a></h4>
          <p class="description">Botol plastik apa pun dapat digunakan untuk membuat Eco-brick, tetapi botol yang paling tepat untuk digunakan ditemukan berukuran 500 ml. Siapkan botol plastik, sampah non organik dan non biologi, gunting dan kayu/tongkat untuk memadatkan.</p>
        </div>

        <span class="float-left">Sumber : <a href="https://zerowaste.id/manajemen-sampah/ecobricks">https://zerowaste.id/manajemen-sampah/ecobricks/</a></span>

      </div>
    </div>

  </div>
</section><!-- End About Section -->

<!-- ======= Gallery Section ======= -->
<section id="gallery" class="gallery">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <p>Gambar Ecobrick</p>
      <h2>Pengaplikasian</h2>
      <div class="text-right">
        <button data-toggle="modal" data-target="#modalCreate" class="btn btn-primary fas float-right mr-4" style="margin-left: auto;" title="Kasih Saran disini">Kasih Saran</button>
      </div>
    </div>

    <div class="row no-gutters mt-3" data-aos="fade-left">

    @if($data)
      @foreach($data as $datas)
      <div class="col-lg-3 col-md-4">
        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
          <a href="{{$datas->ambilFoto()}}" class="venobox" data-gall="gallery-item">
            <img src="{{$datas->ambilFoto()}}" alt="" class="img-fluid">
          </a>
        </div>
      </div>
      @endforeach
    @endif

    </div>

  </div>
</section><!-- End Gallery Section -->

@include('home.include.tambah')

@endsection