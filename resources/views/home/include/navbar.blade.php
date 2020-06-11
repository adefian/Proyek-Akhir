      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#header">Home</a></li>
          <li><a href="#features">Agenda</a></li>
          <li><a href="#details">Maps</a></li>
          <li><a href="#contact">Feedback</a></li>
          <li><a href="/ecobrick">Ecobrick</a></li>
              @if (Route::has('register'))
                <li><a href="{{ route('register') }}">Daftar Komunitas</a></li>
              @endif
            @if (Route::has('login'))
              @auth
                @if(Auth()->user()->role == 'pimpinanecoranger')
                  <li><a href="/pimpinan">Masuk</a></li>
                @elseif(Auth()->user()->role == 'komunitas')
                  <li><a href="/komunitas">Masuk</a></li>
                @elseif(Auth()->user()->role == 'petugaslapangan')
                  <li><a href="petugaslapangan">Masuk</a></li>
                @endif
              @else
                <li class="drop-down"><a>Akun</a>
                  <ul>
                  <li><a href="login">Login</a></li>
                  </ul>
                </li>
              @endauth
            @endif

        </ul>
      </nav><!-- .nav-menu -->