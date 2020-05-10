<nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <!-- <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            
          </div> -->
        </form>
        <ul class="navbar-nav navbar-right">

          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="{{asset('assets/img/avatar/avatar-1.png')}}" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b>
                    <p>Hello, Bro!</p>
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="{{asset('assets/img/avatar/avatar-2.png')}}" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Dedik Sugiharto</b>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="{{asset('assets/img/avatar/avatar-3.png')}}" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Agung Ardiansyah</b>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="{{asset('assets/img/avatar/avatar-4.png')}}" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Ardian Rahardiansyah</b>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                    <div class="time">16 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="{{asset('assets/img/avatar/avatar-5.png')}}" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Alfa Zulkarnain</b>
                    <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>

          @if(is_null($notiftempatsampah))
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
           @else
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i class="far fa-bell"></i></a>
          @endif

          @if(is_null($notiftempatsampah))
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">Notifikasi
              <div class="float-right">
                <!-- <a href="#">Mark All As Read</a> -->
              </div>
            </div>
            <div class="dropdown-list-content dropdown-list-icons">
            @foreach($notiftempatsampah as $data)
                  <a href="indikasi" class="dropdown-item dropdown">
                    <div class="dropdown-item-icon bg-danger text-white">
                      <i class="fas fa-trash"></i>
                    </div>
                    <div class="dropdown-item-desc">
                      {{$data->namalokasi}}
                      <div class="time text-danger">Penuh</div>
                    </div>
                  </a>
            @endforeach
            @else
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">Tidak ada Notifikasi
              <div class="float-right">
                <!-- <a href="#">Mark All As Read</a> -->
              </div>
            </div>
            <div class="dropdown-list-content dropdown-list-icons">
          @endif
                </div>
              </div>
            </li>
          @yield('navbar')
        </ul> 
      </nav>