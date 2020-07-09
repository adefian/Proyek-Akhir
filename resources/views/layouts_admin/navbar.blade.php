<nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <!-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
          </ul>
          <!-- <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            
          </div> -->
        </form>
        <ul class="navbar-nav navbar-right">
        @if(count($notifagenda) >= 1)
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" title="Pesan" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
          @elseif(count($notifsampahmasuk) >= 1)
            @if(auth()->user()->role == 'pimpinanecoranger' || auth()->user()->role == 'petugaslapangan')
              <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" title="Pesan" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            @endif
          @elseif(count($notifvalidasi) >= 1)
            @if(auth()->user()->role == 'pimpinanecoranger')
              <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" title="Pesan" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            @endif
         @else
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" title="Pesan" class="nav-link nav-link-lg message-toggle"><i class="far fa-envelope"></i></a>
        @endif
          @if(count($notifagenda) >= 1)
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Pesan
                <div class="float-right">
                  <!-- <a href="#">Mark All As Read</a> -->
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
              @foreach($notifagenda as $data)
                <a href="{{route('kelolaagenda.index')}}" class="dropdown-item dropdown-item">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-calendar"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>{{$data->nama}}</b> 
                    <p>Komunitas {{$data->komunitas->daerah}}</p>
                    <p>{{ Carbon\Carbon::parse($data->tanggal)->isoFormat('LLLL') }} WIB</p>
                    @if($data->created_at == $data->updated_at)
                    <div class="time text-success">Telah Ditambahkan {{$data->updated_at->diffForHumans()}}</div>
                    @else
                    <div class="time text-warning">Telah Diperbarui {{$data->updated_at->diffForHumans()}}</div>
                    @endif
                    <p>Oleh {{$data->petugasygmenambahkan->username}}</p>
                  </div>
                </a>
              @endforeach
            @elseif(count($notifsampahmasuk) >= 1)
                  @if(auth()->user()->role == 'pimpinanecoranger' || auth()->user()->role == 'petugaslapangan')
                  <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">Pesan
                      <div class="float-right">
                        <!-- <a href="#">Mark All As Read</a> -->
                      </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                      @foreach($notifsampahmasuk as $data)
                        @if(auth()->user()->role == 'pimpinanecoranger')
                        <a href="{{route('riwayatpembuangan.index')}}" class="dropdown-item dropdown-item">
                        @elseif(auth()->user()->role == 'petugaslapangan')
                        <a href="{{route('riwayatpembuangan-petugaslap.index')}}" class="dropdown-item dropdown-item">
                        @endif
                          <div class="dropdown-item-icon bg-danger text-white">
                            <i class="fas fa-trash"></i>
                          </div>
                          <div class="dropdown-item-desc">
                            @if($data->status == 'penuh')
                              <b>Sampah Masuk dengan Benar</b> 
                              @else
                              <b>Sampah Salah dimasukkan</b> 
                            @endif
                            <p>Tempat Sampah</p>
                            @if($data->created_at == $data->updated_at)
                              <div class="time">{{$data->updated_at->diffForHumans()}}</div>
                            @endif
                          </div>
                        </a>
                      @endforeach
                    @endif
                @endif
                @if(count($notifvalidasi) >= 1)
                  @if(auth()->user()->role == 'pimpinanecoranger')
                  <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">Pesan
                      <div class="float-right">
                        <!-- <a href="#">Mark All As Read</a> -->
                      </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                      @foreach($notifvalidasi as $data)
                        <a href="{{route('validasi.index')}}" class="dropdown-item dropdown-item">
                          <div class="dropdown-item-icon bg-warning text-white">
                            <i class="fas fa-tag"></i>
                          </div>
                          <div class="dropdown-item-desc">
                            <b>Perlu Validasi</b>
                            <p>Daerah {{$data->daerah}}</p>
                            @if($data->created_at == $data->updated_at)
                              <div class="time">Diajukan {{$data->updated_at->diffForHumans()}}</div>
                            @endif
                          </div>
                        </a>
                      @endforeach
                  @endif
                @else
                  <div class="dropdown-menu dropdown-list dropdown-menu-right">
                  <div class="dropdown-header">Tidak ada Notifikasi
                    <div class="float-right">
                      <!-- <a href="#">Mark All As Read</a> -->
                    </div>
                  </div>
                  <div class="dropdown-list-content dropdown-list-icons">
              </div>
            </div>
          </li>
        @endif

<!-- ass -->

          @if(count($notiftempatsampah) >= 1 || count($notifagendamendesak) >= 1 || count($notifambilsampah) >= 1)
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" title="Notifikasi" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
           @else
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" title="Notifikasi" class="nav-link notification-toggle nav-link-lg"><i class="far fa-bell"></i></a>
          @endif

          @if(count($notiftempatsampah) >= 1 || count($notifagendamendesak) >= 1)
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">Notifikasi
              <div class="float-right">
                <!-- <a href="#">Mark All As Read</a> -->
              </div>
            </div>
            <div class="dropdown-list-content dropdown-list-icons">
            @foreach($notifagendamendesak as $data)
              @if(auth()->user()->role == 'pimpinanecoranger')
                  <a href="{{route('kelolaagenda.index')}}" class="dropdown-item dropdown">
              @elseif(auth()->user()->role == 'komunitas')
                  <a href="{{route('kelolaagenda-komunitas.index')}}" class="dropdown-item dropdown">
              @elseif(auth()->user()->role == 'pimpinankomunitas')
                  <a href="{{route('kelolaagenda-pimpinankom.index')}}" class="dropdown-item dropdown">
              @endif
                    <div class="dropdown-item-icon bg-primary text-white">
                      <i class="fas fa-calendar"></i>
                    </div>
                    <div class="dropdown-item-desc">
                      <b>{{$data->nama}}</b>
                      <p>Komunitas {{$data->komunitas->daerah}}</p>
                      <p>{{ Carbon\Carbon::parse($data->tanggal)->isoFormat('LLLL') }} WIB</p>
                      <div class="time text-primary">Agenda Penting, Yuk Ikutan !</div>
                    </div>
                  </a>
            @endforeach
              @if(auth()->user()->role == 'pimpinanecoranger' || auth()->user()->role == 'petugaslapangan')
                @foreach($notiftempatsampah as $data)
                      @if(auth()->user()->role == 'pimpinanecoranger')
                      <a href="{{route('indikasi.index')}}" class="dropdown-item dropdown-item">
                      @elseif(auth()->user()->role == 'petugaslapangan')
                      <a href="{{route('indikasi-petugaslap.index')}}" class="dropdown-item dropdown-item">
                      @endif
                    <div class="dropdown-item-icon bg-danger text-white">
                      <i class="fas fa-trash"></i>
                    </div>
                    <div class="dropdown-item-desc">
                      <b>Sampah Penuh<br></b>
                      {{$data->nama}}
                      <div class="time text-danger">Penuh, {{$data->updated_at->diffForHumans()}}</div>
                    </div>
                  </a>
                @endforeach
                  @foreach($notifambilsampah as $data)
                      @if(auth()->user()->role == 'pimpinanecoranger')
                      <a href="{{route('indikasi.index')}}" class="dropdown-item dropdown-item">
                      @elseif(auth()->user()->role == 'petugaslapangan')
                      <a href="{{route('indikasi-petugaslap.index')}}" class="dropdown-item dropdown-item">
                      @endif
                      <div class="dropdown-item-icon bg-warning text-white">
                        <i class="fas fa-trash"></i>
                      </div>
                      <div class="dropdown-item-desc">
                        <b>Pengambilan Sampah Penuh<br></b>
                        {{$data->nama}}
                        <div class="time">{{$data->petugasygmenambahkan->username}}</div>
                        <div class="time text-danger">{{$data->updated_at->diffForHumans()}}</div>
                      </div>
                    </a>
                  @endforeach
              @endif
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