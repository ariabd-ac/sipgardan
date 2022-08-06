<nav>
    
    <div class="sidebar-top">
        <span class="shrink-btn">
            <i class="bx bx-chevron-left"></i>
        </span>
        <img src="{{ asset('img\logo.png') }}" alt="" class="logo">
        <h3 class="hide">Parking Apps</h3>
        <div class="icon-menu-sidebar">
            <i class="bx bx-menu"></i>
        </div>
    </div>

    <div class="sidebar-links">
        <ul>
            <div class="active-tab"></div>
            <li class="tooltip-element" data-tooltip="0">
                <a href="#" class="@if (Request::is('/')) active @endif" data-active="0"
                    data-link="{{ route('home') }}">
                    <div class="icon-sidebar">
                        <i class="bx bx-tachometer"></i>
                        <i class="bx bxs-tachometer"></i>
                    </div>
                    <span class="link hide">Dashboard</span>
                </a>
            </li>
            <li class="tooltip-element" data-tooltip="1">
                <a href="#" class="@if (Request::is('parking')) active @endif" data-active="1"
                    data-link="{{ route('parking') }}">
                    <div class="icon-sidebar">
                        <i class='bx bxs-parking'></i>
                        <i class='bx bxs-parking'></i>
                    </div>
                    <span class="link hide">Parkir</span>
                </a>
            </li>
            {{-- <li class="tooltip-element" data-tooltip="2">
                <a href="#" class="@if (Request::is('rate')) active @endif" data-active="2"
                    data-link="{{ route('rate') }}">
                    <div class="icon-sidebar">
                        <i class='bx bx-dollar-circle'></i>
                        <i class='bx bxs-dollar-circle'></i>
                    </div>
                    <span class="link hide">Tarif</span>
                </a>
            </li> --}}

            @role('admin')
            <li class="tooltip-element" data-tooltip="2">
                <a href="#" class="@if (Request::is('report')) active @endif" data-active="2"
                    data-link="{{ route('report') }}">
                    <div class="icon-sidebar">
                        <i class="bx bx-file"></i>
                        <i class="bx bxs-file"></i>
                    </div>
                    <span class="link hide">Laporan</span>
                </a>
            </li>

            <li class="tooltip-element" data-tooltip="3">
                <a href="#" class="@if (Request::is('user')) active @endif" data-active="3"
                    data-link="{{ route('user') }}">
                    <div class="icon-sidebar">
                        <i class="bx bx-user"></i>
                        <i class="bx bxs-user"></i>
                    </div>
                    <span class="link hide">User</span>
                </a>
            </li>
            @endrole

            <div class="tooltip">
                <span class="show">Dashboard</span>
                <span>Parkir</span>
                {{-- <span>Tarif</span> --}}
                <span>Laporan</span>
                <span>User</span>
            </div>
        </ul>
    </div>

    <div class="sidebar-footer">
        <a href="#" class="account tooltip-element" data-tooltip="0">
            <i class='bx bx-user'></i>
        </a>
        <div class="admin-user tooltip-element" data-tooltip="1">
            <div class="admin-profile hide">
                <img src="{{ asset('img\profile.svg') }}" alt="">
                <div class="admin-info">
                    <h3>{{ Auth::user()->name }}</h3>
                    <h5>{{ Auth::user()->is_admin == 1 ? 'Admin' : 'Operator' }}</h5>
                </div>
            </div>
            <a href="#" class="log-out" id="logout-btn">
                <i class="bx bx-log-out"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <div class="tooltip">
            <span class="show">{{ Auth::user()->name }}</span>
            <span>Logout</span>
        </div>

    </div>
</nav>
