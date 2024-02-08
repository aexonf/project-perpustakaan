<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin') }}">PERPUS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin') }}">SMK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin') }}" id="route-admin"><i class="fas fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            {{-- @if (Auth::user()->role == 'admin' || \App\Models\Librarian::where('user_id', auth()->user()->id)->exists()) --}}
                <li class="{{ Request::is('admin/buku') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('book') }}" id="route-admin"><i class="fa-solid fa-book"></i>
                        <span>Buku</span></a>
                </li>
            {{-- @endif --}}

            {{-- @if (\App\Models\Librarian::where('user_id', auth()->user()->id)->exists()) --}}
                <li class="{{ Request::is('admin/pinjaman') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('loan') }}" id="route-admin">
                        <i class="fa fa-tasks"></i>
                        <span>Pinjaman</span>
                    </a>
                </li>
            {{-- @endif --}}


            {{-- @if (Auth::user()->role == 'admin') --}}
                <li class="{{ Request::is('admin/penjaga') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('penjaga') }}" id="route-admin"><i class="fa fa-user-circle"></i>
                        <span>Penjaga</span></a>
                </li>
            {{-- @endif --}}
        </ul>

    </aside>
</div>
