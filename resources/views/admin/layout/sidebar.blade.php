<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li> -->
        <!-- -->
        <!-- -->
        <!-- <li class="nav-item nav-category">{{ __('dashboard.section') }}</li> -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-sitemap"></i>
                <span class="menu-title">{{ __('dashboard.Departments') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse show" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('departments.index') }}">{{ __('dashboard.Show_Departments') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('departments.create') }}">{{ __('dashboard.Create_Department') }}</a></li>
                </ul>
            </div>
        </li>
        <!-- -->
        <!-- -->
        <!-- <li class="nav-item nav-category">{{ __('dashboard.Certificates') }}</li> -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-group"></i>
                <span class="menu-title">{{ __('dashboard.Certificates') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse show" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('certifications.index') }}">{{ __('dashboard.Show_Certificates') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('certifications.create') }}">{{ __('dashboard.Create_Certificates') }}</a></li>
                </ul>
            </div>
        </li>
        <!-- -->
        <!-- -->
        <!-- <li class="nav-item nav-category">{{ __('dashboard.Fonts') }}</li> -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">{{ __('dashboard.Fonts') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse show" id="ui-basic3">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('fonts.index') }}">{{ __('dashboard.Show_Fonts') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('fonts.create') }}">{{ __('dashboard.Create_Font') }} </a></li>
                </ul>
            </div>
        </li>
        <!-- -->
        <!-- -->
        <!-- <li class="nav-item nav-category">{{ __('dashboard.Google_AdSense') }}</li> -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-elevation-rise"></i>
                <span class="menu-title">{{ __('dashboard.Google_AdSenses') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse show" id="ui-basic4">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('adsenses.index') }}">{{ __('dashboard.Show_Google_AdSense') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('adsenses.create') }}">{{ __('dashboard.Create_Google_AdSense') }}</a></li>
                </ul>
            </div>
        </li>
        <!-- -->
        <!-- -->
        <!-- <li class="nav-item nav-category">{{ __('dashboard.Statics') }}</li> -->
        <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-chart-areaspline"></i>
                <span class="menu-title">{{ __('dashboard.Statics') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse show" id="ui-basic4">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Statics Users</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Statics Certificates</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Statics orders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Statics downloads</a></li>
                </ul>
            </div>
        </li> -->
    </ul>
</nav>