<ul class="sidebar-menu-pimpinankomunitas">
  <li class="menu-header">Beranda</li>
  <li class="active">
      <a class="nav-link active" href="{{route('pimpinan-komunitas.index')}}"><i class="fas fa-seedling"></i><span>Beranda</span></a>
  </li>
  <li class="menu-header">Monitoring</li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Monitoring Komunitas</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="{{route('daftarkomunitas-pimpinankom.index')}}">Daftar Komunitas</a></li>
      <li><a class="nav-link" href="{{route('kelolaagenda-pimpinankom.index')}}">Kelola Agenda</a></li>
    </ul>
  </li>
  <li class="menu-header">Manajemen</li>
  <li class="nav-item dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-leaf"></i> <span>Manajemen</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="{{route('dataanggotakomunitas-pimpinankom.index')}}">Data Anggota Komunitas</a></li>
      <li><a class="nav-link" href="{{route('reviewsaranecobrick-pimpinankom.index')}}">Ulasan Saran Ecobrick</a></li>
      <li><a class="nav-link" href="{{route('feedbacks-pimpinankom')}}">Feedback</a></li>
      <li><a class="nav-link" href="{{route('laporan-pimpinankom.index')}}">Laporan</a></li>
    </ul>
  </li>

  <!-- <li class="menu-header">Laporan</li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="/laporan-pimpinankom"><i class="fas fa-file"></i><span>Laporan Agenda</span></a>
  </li> -->

</ul>

  <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
    <a href="{{route('home')}}" class="btn btn-primary-pimpinankomunitas btn-lg btn-block btn-icon-split">
      <i class="fas fa-rocket"></i> Halaman Awal
    </a>
  </div>