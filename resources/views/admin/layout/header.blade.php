<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <!-- -->
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <!-- -->
        <div class="me-3 toggle-btn-sidebar">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <!-- -->
        <div>
            <a class="navbar-brand brand-logo" href="{{ url('/') }}">
                <img src="{{ asset('asset/images/logo-w.png') }}" alt="logo" />
                
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
                <img src="{{ asset('asset/images/logo-w.png') }}" alt="logo" />
            </a>
        </div>
        <!-- -->
    </div>
    <!-- -->
    <!-- -->
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <!-- -->
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">{{ __('dashboard.Good_Morning') }} <span class="text-black fw-bold">Admin</span></h1>
                <h3 class="welcome-sub-text">{{ __('dashboard.start_your_process') }} </h3>
            </li>
        </ul>
        <!-- -->
        <!-- -->
        <ul class="navbar-nav ms-auto">
            <!-- -->
            <!-- -->
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="{{ asset('asset/images/faces/face8.jpg') }}" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="{{ asset('asset/images/faces/face8.jpg') }}" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
                        <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
                    </div>
                    
                    <a href="{{ route('admin_reset_password') }}"
                       class="dropdown-item">
                       <i class="dropdown-item-icon mdi mdi-settings text-primary me-2"></i>
                       {{ __('dashboard.edit_dashboard')}}
                    </a>

                    <a onclick="document.getElementById('logout_form').submit();" 
                       class="dropdown-item">
                       <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                       {{ __('dashboard.Sign_Out')}}
                    </a>
                    <!-- logout form -->
                    <form id="logout_form" 
                          style="display: none"
                          method="POST" 
                          action="{{ route('logout') }}">
                        @csrf
                    </form>
                </div>
            </li>
            <!-- -->
            <!-- -->
        </ul>
        <!-- -->
        <!-- -->
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
    <!-- -->
</nav>