<ul class="sidebar-menu-komunitas">
  <li class="menu-header">Beranda</li>
  <li class="active">
      <a class="nav-link active" href="{{ route('komunitas.index')}}"><i class="fas fa-seedling"></i><span>Beranda</span></a>
  </li>
  
  <li class="menu-header">Manajemen</li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('daftarkomunitas-komunitas.index')}}"><i class="fas fa-users"></i><span>Daftar Komunitas</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('kelolaagenda-komunitas.index')}}"><i class="fas fa-calendar-week"></i><span>Kelola Agenda</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" href="{{route('reviewsaranecobrick-komunitas.index')}}"><i class="fas fa-leaf"></i><span>Review Saran Ecobrick</span></a>
  </li>
</ul>

  <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
    <a href="{{ route('home')}}" class="btn btn-primary-komunitas btn-lg btn-block btn-icon-split">
      <i class="fas fa-rocket"></i> Halaman Awal
    </a>
  </div>
