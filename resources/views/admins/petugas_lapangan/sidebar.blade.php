<ul class="sidebar-menu-petugaslap">
  <li class="menu-header">Beranda</li>
  <li class="active">
      <a class="nav-link active-petugaslapangan" href="{{route('petugaslapangan.index')}}"><i class="fas fa-fire"></i><span>Beranda</span></a>
  </li>
  <li class="menu-header">Monitoring</li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Monitoring Tempat Sampah Pintar</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="{{route('indikasi-petugaslap.index')}}">Indikasi Sampah Penuh</a></li>
      <li><a class="nav-link" href="{{route('lokasisampah-petugaslap')}}">Lokasi</a></li>
    </ul>
  </li>
  <li class="nav-item dropdown">
      <a class="nav-link" href="{{route('daftarkomunitas-petugaslap.index')}}"><i class="fas fa-users"></i><span>Daftar Komunitas</span></a>
  </li>
  <li class="menu-header">Manajemen</li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('datapetugaslapangan-petugaslap.index')}}"><i class="fas fa-user-shield"></i><span>Data Petugas Lapangan</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('riwayatpembuangan-petugaslap.index')}}"><i class="fas fa-box-open"></i><span>Riwayat Pembuangan Sampah</span></a>
  </li>
</ul>

  <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
    <a href="{{route('home')}}" class="btn btn-primary-petugaslap btn-lg btn-block btn-icon-split">
      <i class="fas fa-rocket"></i> Halaman Awal
    </a>
  </div>