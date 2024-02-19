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

                <li class="{{ Request::is('admin/buku') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('book') }}" id="route-admin"><i class="fa-solid fa-book"></i>
                        <span>Buku</span></a>
                </li>

                <li class="{{ Request::is('admin/pinjaman') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('loan') }}" id="route-admin">
                        <i class="fa fa-tasks"></i>
                        <span>Pinjaman</span>
                    </a>
                </li>

                <li
                class="nav-item dropdown {{ request()->path() === 'admin/user/management' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>User Management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->path() === 'admin/user/management/student' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('student.management') }}">
                            <span>User</span></a>
                    </li>
                    <li class="{{ request()->path() === 'admin/user/management/teacher' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('teacher.management') }}">
                            <span>Guru</span></a>
                    </li>
                    <li class="{{ request()->path() === 'admin/user/management/librarian' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('librarian.management') }}">
                            <span>Perpustakawan</span></a>
                    </li>
                </ul>
            </li>



        </ul>

    </aside>
</div>
