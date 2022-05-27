    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/'.explode('/',Request::path())[0]) }}">
        <div class="sidebar-brand-icon">
          <img src="{{ asset('img/logo/logomark.png') }}"> 
          <!--<i class="fas fa-smile-wink"></i>-->
        </div>
        <div class="sidebar-brand-text mx-3">
          <span class="brand-text text-dark">MUDA</span>
		      <span class="brand-system text-uppercase">@yield('brand-system')</span>
        </div>
      </a>
      <hr class="sidebar-divider my-0">
	  @yield('sidebar-menu')
	  
      <div class="version" id="version-sista"></div>
    </ul>
