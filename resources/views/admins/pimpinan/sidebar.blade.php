<ul class="sidebar-menu">
  <li class="menu-header">Beranda</li>
  <li class="active">
      <a class="nav-link active" href="{{route('pimpinan.index')}}"><i class="fas fa-seedling"></i><span>Beranda</span></a>
  </li>
  <li class="menu-header">Monitoring</li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-dumpster"></i> <span>Monitoring Tempat Sampah Pintar</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="{{route('indikasi.index')}}">Indikasi Sampah Penuh</a></li>
      <li><a class="nav-link" href="{{route('lokasisampah')}}">Lokasi</a></li>
    </ul>
  </li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Monitoring Komunitas</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="{{route('daftarkomunitas.index')}}">Daftar Komunitas</a></li>
      <li><a class="nav-link" href="{{route('kelolaagenda.index')}}">Kelola Agenda</a></li>
      <li><a class="nav-link" href="{{route('validasi.index')}}">Validasi</a></li>

    </ul>
  </li>
  <li class="menu-header">Manajemen</li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tag"></i> <span>Data</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="{{route('datapimpinankomunitas.index')}}">Data Pimpinan Komunitas</a></li>
      <li><a class="nav-link" href="{{route('dataanggotakomunitas.index')}}">Data Anggota Komunitas</a></li>
      <li><a class="nav-link" href="{{route('datapetugaslapangan.index')}}">Data Petugas Lapangan</a></li>
      <li><a class="nav-link" href="{{route('datapetugaskontenreward.index')}}">Data Petugas Konten Reward</a></li>

    </ul>
  </li>

  <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('reviewsaranecobrick.index')}}"><i class="fas fa-leaf"></i><span>Ulasan Saran Ecobrick</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('riwayatpembuangan.index')}}"><i class="fas fa-box-open"></i><span>Riwayat Pembuangan Sampah</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('feedbacks')}}"><i class="fas fa-folder"></i><span>Feedback</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('laporan.index')}}"><i class="fas fa-folder"></i><span>Laporan</span></a>
  </li>

</ul>

  <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
    <a href="{{route('home')}}" class="btn btn-primary btn-lg btn-block btn-icon-split">
      <i class="fas fa-rocket"></i> Halaman Awal
    </a>
  </div>
