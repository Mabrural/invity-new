<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href=" {{ route('dashboard') }} "
            target="">
            <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26"
                alt="main_logo">
            <span class="ms-1 text-sm text-dark">Invity</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
        href="{{ route('dashboard') }}">
        <i class="material-symbols-rounded opacity-5">dashboard</i>
        <span class="nav-link-text ms-1">Dashboard</span>
    </a>
</li>

{{-- EVENT --}}
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('events.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
        href="{{ route('events.index') }}">
        <i class="material-symbols-rounded opacity-5">event</i>
        <span class="nav-link-text ms-1">Event</span>
    </a>
</li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-dark w-100">
                    <i class="material-symbols-rounded opacity-5">logout</i> Logout
                </button>
            </form>


        </div>
    </div>
</aside>
