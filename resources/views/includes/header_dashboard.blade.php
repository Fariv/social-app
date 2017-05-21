<header>
  <nav class="navbar navbar-default topbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topbar-collapsible" aria-expanded="false">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="{{ route('dashboard') }}" class="navbar-brand brand-name">SOCIAL APP</a>
      </div>

      <div class="collapse navbar-collapse" id="topbar-collapsible">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ route('account') }}">Account</a></li>
          <li><a href="{{ route('user.logout') }}">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
