<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dashboard') }}" class="brand-link">
    <!-- <center> -->
    <!-- <img src="{{ asset('public/images/favicon.png') }}"
         alt="JCT"
         class="brand-image img-circle elevation-3"> -->
      <!-- <i class="fa fa-home"></i> -->
    <span class="brand-text font-weight-light">In-Line QC Monitoring</span>
    <!-- </center> -->
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        @if(Auth::user()->user_level == 1)
        <li class="nav-item has-treeview">
          <a href="{{ route('users') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
            </p>
          </a>
        </li>
        @endif
        
        <li class="nav-item has-treeview">
          <a href="{{ route('lines') }}" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Lines
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('stations') }}" class="nav-link">
            <i class="nav-icon fas fa-cube"></i>
            <p>
              Stations
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('monitoring') }}" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Monitoring
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>