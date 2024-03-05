<nav
    class="main-header navbar navbar-expand navbar-{{ Auth::user()->mode }} navbar-light"
>
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user"></i>
                {{ Auth::user()->getFullNameAttribute() }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <span class="dropdown-header">
                    {{ __('common.user_settings') }}
                </span>
                <div class="dropdown-divider"></div>

                <!-- Profile Link -->
                <a
                    href="{{ route('admin.profile.edit') }}"
                    class="dropdown-item"
                >
                    {{ __('profile.profile') }}
                </a>

                <div class="dropdown-divider"></div>
                <!-- Logout Link -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        {{ __('auth.logout') }}
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
