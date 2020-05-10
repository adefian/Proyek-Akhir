<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img alt="image" src="{{asset('assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
    <div class="d-sm-none d-lg-inline-block">Hi, {{auth()->user()->nama}}</div></a>
    <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">Logged in 5 min ago</div>
        <a href="features-profile.html" class="dropdown-item has-icon">
        <i class="far fa-user"></i> Profile
        </a>
        <a href="features-activities.html" class="dropdown-item has-icon">
        <i class="fas fa-bolt"></i> Activities
        </a>
        <a href="features-settings.html" class="dropdown-item has-icon">
        <i class="fas fa-cog"></i> Settings
        </a>
        <div class="dropdown-divider"></div>
            
            <a href="#" data-id="logout-komunitas" class="dropdown-item has-icon text-danger" data-confirm="Keluar|Apakah anda yakin ingin keluar sekarang ?">
                <button class="btn btn-danger fas fa-sign-out-alt">Logout
                </button>
            </a>

    </div>
</li>