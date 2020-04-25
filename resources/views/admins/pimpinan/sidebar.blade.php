<ul class="sidebar-menu">
  <li class="menu-header">Beranda</li>
  <li class="active">
      <a class="nav-link active" href="{{ route('pimpinan.index')}}"><i class="fas fa-seedling"></i><span>Beranda</span></a>
  </li>
  <li class="menu-header">Monitoring</li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-dumpster"></i> <span>Monitoring Tempat Sampah Pintar</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="/indikasi">Indikasi Sampah Penuh</a></li>
      <li><a class="nav-link" href="/lokasisampah">Lokasi</a></li>
    </ul>
  </li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Monitoring Komunitas</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="/lokasiagenda">Lokasi</a></li>
      <li><a class="nav-link" href="/kelolaagenda">Kelola Agenda</a></li>
    </ul>
  </li>
  <li class="menu-header">Manajemen</li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-calendar-alt"></i> <span>Data Komunitas</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="/daftarkomunitas">Daftar Komunitas</a></li>
      <li><a class="nav-link" href="/validasi">Validasi</a></li>
    </ul>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="/datapetugaslapangan"><i class="fas fa-user-shield"></i><span>Data Petugas Lapangan</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="/reviewsaranecobrick"><i class="fas fa-leaf"></i><span>Review Saran Ecobrick</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="/daftarsampah"><i class="fas fa-box-open"></i><span>Daftar Sampah Masuk</span></a>
  </li>

</ul>
