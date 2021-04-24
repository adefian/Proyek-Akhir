      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <!-- <li class="active"><a href="#header">Home</a></li> -->
          <li><a href="#features">Agenda</a></li>
          <li><a href="#details">Maps</a></li>
          <li><a href="#contact">Feedback</a></li>
          <li><a href="{{route('ecobrick')}}">Ecobrick</a></li>
              
            @if (Route::has('login'))
              @auth
                @if(Auth()->user()->role == 'pimpinanecoranger')
                  <li><a href="{{route('pimpinan.index')}}">Masuk</a></li>
                @elseif(Auth()->user()->role == 'komunitas')
                  <li><a href="{{route('komunitas.index')}}">Masuk</a></li>
                @elseif(Auth()->user()->role == 'petugaslapangan')
                  <li><a href="{{route('petugaslapangan.index')}}">Masuk</a></li>
                @elseif(Auth()->user()->role == 'pimpinankomunitas')
                  <li><a href="{{route('pimpinan-komunitas.index')}}">Masuk</a></li>
                @endif
              @else
                <li class="drop-down"><a>Akun</a>
                  <ul>
                  <li><a href="{{route('login')}}">Login</a></li>
                  @if (Route::has('register'))
                    <li><a href="{{route('register') }}">Daftar sebagai </br>Anggota Komunitas</a></li>
                  @endif
                  </ul>
                </li>
              @endauth
            @endif


        </ul>
      </nav><!-- .nav-menu -->