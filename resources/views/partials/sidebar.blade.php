@if (auth()->check() && in_array(auth()->user()->role->name, ['admin', 'moderator']))
    <nav id="sidebarMenu" class="col-md-3 col-lg-3 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
            <ul class="nav flex-column">

                <!-- Dashboard (all users) -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                        <i class="fa fa-tachometer-alt fa-fw"></i>
                        Dashboard
                    </a>
                </li>



                <!-- Users Module -->
                @if ($hasPermission('users', 'view') || $hasPermission('users', 'update') || $hasPermission('users', 'delete'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
                            href="{{ route('admin.user.management') }}">
                            <i class="fa fa-users fa-fw"></i>
                            Users Management
                        </a>

                    </li>
                @endif

                <!-- Search Module -->
                @if ($hasPermission('search', 'view') || $hasPermission('search', 'update') || $hasPermission('search', 'delete'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/users/search') ? 'active' : '' }}"
                            href="{{ route('admin.users.search') }}">
                            <i class="fa fa-search fa-fw"></i>
                            Search Users
                        </a>

                    </li>
                @endif

                <!-- Content Moderation (for moderator role) -->
                @if (auth()->user()->role->name === 'moderator' && $hasPermission('content', 'view'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/content-moderation') ? 'active' : '' }}"
                            href="{{ route('admin.content.moderation') }}">
                            <i class="fa fa-shield-alt fa-fw"></i>
                            Content Moderation Tools
                        </a>
                    </li>
                @endif

            </ul>

            <!-- Logout -->
            <ul class="nav flex-column mb-2 mt-auto pt-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt fa-fw"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
@endif
