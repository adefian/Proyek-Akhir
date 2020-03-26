<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <img style="width: 30%;" src="{{asset('assets/img/SmartBin.png')}}" alt="logo">
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <img style="width: 50%;" src="{{asset('assets/img/SmartBin.png')}}" alt="logo">
          </div>
        
          @yield('sidebar')
          
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="/" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Halaman Awal
          </a>
        </div>
        </aside>
      </div>