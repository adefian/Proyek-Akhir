<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <!-- <img alt="image" src="{{asset('foto_user/avatar-3.png')}}" class="rounded-circle mr-1"> -->
    <div class="d-sm-none d-lg-inline-block">Hai, {{auth()->user()->username}}</div></a>
    <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">{{auth()->user()->role}}</div>
        <a href="{{route('pimpinan-komunitas.show', [auth()->user()->id])}}" class="dropdown-item has-icon">
        <i class="fas fa-user"></i> Profil
        </a>
        <a href="{{route('pimpinan-komunitas.show', [auth()->user()->id])}}" class="dropdown-item has-icon">
        <i class="fas fa-key"></i> Ganti Password
        </a>
        <a href="{{route('pimpinan-komunitas.show', [auth()->user()->id])}}" class="dropdown-item has-icon">
        <i class="fas fa-cog"></i> Pengaturan
        </a>
        <div class="dropdown-divider"></div>
            
            <a href="#" data-href="{{route('logout-pimpinankom')}}" class="dropdown-item has-icon text-danger" data-confirm="Keluar|Apakah anda yakin ingin keluar sekarang ?">
                <button class="btn btn-danger far fa-sign-out-alt">Keluar
                </button>
            </a>

    </div>
</li>
