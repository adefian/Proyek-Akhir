<ul class="sidebar-menu">
  <li class="menu-header">Dashboard</li>
  <li class="active">
      <a class="nav-link active" href="{{ route('petugaslapangan.index')}}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
  </li>
  <li class="menu-header">Monitoring</li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Monitoring Tempat Sampah Pintar</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="{{ route('indikasi.index')}}">Indikasi Sampah Penuh</a></li>
      <li><a class="nav-link" href="{{ route('lokasisampah')}}">Lokasi</a></li>
    </ul>
  </li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Monitoring Komunitas</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="{{ route('kelolaagenda.index')}}">Kelola Agenda</a></li>
      <li><a class="nav-link" href="{{ route('lokasikomunitas')}}">Lokasi</a></li>
    </ul>
  </li>
  <li class="menu-header">Management</li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Data Komunitas</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="{{ route('daftarkomunitas.index')}}">Daftar Komunitas</a></li>
      <li><a class="nav-link" href="{{ route('validasi')}}">Validasi</a></li>
    </ul>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="{{ route('datapetugaslapangan.index')}}"><i class="fas fa-file-alt"></i><span>Data Petugas Lapangan</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="{{ route('reviewsaranecobrick.index')}}"><i class="far fa-file-alt"></i><span>Review Saran Ecobrick</span></a>
  </li>
</ul>
