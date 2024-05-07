<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ route('home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                    Website
                </a>
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'bookings') !== false ? 'active' : '' }}" href="{{ route('bookings') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                    Bookings
                </a>
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'guests') !== false ? 'active' : '' }}" href="{{ route('guests.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                    Guests
                </a>
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'packages') !== false ? 'active' : '' }}" href="{{ route('packages.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                    Packages
                </a>
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'messages') !== false ? 'active' : '' }}" href="{{ route('messages.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                    Messages
                </a>
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'menus') !== false || strpos(Route::currentRouteName(), 'pages') !== false || strpos(Route::currentRouteName(), 'rooms') !== false || strpos(Route::currentRouteName(), 'services') !== false || strpos(Route::currentRouteName(), 'facilities') !== false || strpos(Route::currentRouteName(), 'notices') !== false || strpos(Route::currentRouteName(), 'app-info') !== false || strpos(Route::currentRouteName(), 'users') !== false ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings">
                    <div class="sb-nav-link-icon"><i class="fas fa-wrench"></i></div>
                    Settings
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ strpos(Route::currentRouteName(), 'menus') !== false || strpos(Route::currentRouteName(), 'pages') !== false || strpos(Route::currentRouteName(), 'rooms') !== false || strpos(Route::currentRouteName(), 'addons') !== false || strpos(Route::currentRouteName(), 'facilities') !== false || strpos(Route::currentRouteName(), 'notices') !== false || strpos(Route::currentRouteName(), 'app-info') !== false || strpos(Route::currentRouteName(), 'users') !== false ? 'show' : '' }}" id="collapseSettings" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'app-info') !== false ? 'active' : '' }}" href="{{ route('app-info') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
                            App Info
                        </a>
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'users') !== false ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Users
                        </a>
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'facilities') !== false ? 'active' : '' }}" href="{{ route('facilities.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                            Facilities
                        </a>
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'rooms') !== false ? 'active' : '' }}" href="{{ route('rooms.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-cube"></i></div>
                            Rooms
                        </a>
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'addons') !== false ? 'active' : '' }}" href="{{ route('addons.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                            Addons
                        </a>
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'notices') !== false ? 'active' : '' }}" href="{{ route('notices.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                            Notices
                        </a>
                        @if(Auth::user()->weight > 75)
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'menus') !== false ? 'active' : '' }}" href="{{ route('menus.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                            Menus
                        </a>
                        @endif
                        <a class="nav-link {{ strpos(Route::currentRouteName(), 'pages') !== false ? 'active' : '' }}" href="{{ route('pages.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>