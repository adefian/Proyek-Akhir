        <nav class="navbar navbar-expand-lg main-navbar">		
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon">
			    	<i class="ion-navicon"></i>
			    </span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNav">
				  <div class="mr-auto"></div>
			    <ul class="navbar-nav">
			      <li class="nav-item active">
			        <a class="nav-link smooth-link" href="#hero"><b>Beranda</b></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link smooth-link" href="#features"><b>Tempat Sampah Pintar</b></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link smooth-link" href="#blog"><b>Komunitas</b></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link smooth-link" href="#project"><b>Ecobrick</b></a>
				  </li>
			      <li class="nav-item">
			        <a class="nav-link smooth-link" href="#contactus"><b>Tentang Kami</b></a>
				  </li>
				  <li class="nav-item">
					@if (Route::has('login'))
						@auth
							@if(auth()->user()->role == 'pimpinanecoranger')
								<a href="pimpinan" class="nav-link smooth-link"><b>Masuk</a>
							@endif
							@if(auth()->user()->role == 'petugaslapangan')
								<a href="petugaslapangan" class="nav-link smooth-link"><b>Masuk</a>
							@endif
							@if(auth()->user()->role == 'komunitas')
								<a href="komunitas" class="nav-link smooth-link"><b>Masuk</a>
							@endif
						@else
							<a href="login" class="nav-link smooth-link"><b>Login</a>
						@endauth
					@endif
				  </li>
				  
			    </ul>
			  </div>
		</nav>