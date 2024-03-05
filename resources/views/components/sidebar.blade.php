<aside
    class="main-sidebar sidebar-{{ Auth::user()->mode }}-primary elevation-4"
>
    <div class="sidebar">
        <div class="user-panel d-flex mb-3 mt-3 pb-3">
            <div class="image">
                <!-- <img
                                src="{{ asset('admin/dist/img/user2-160x160.jpg') }}"
                                class="img-circle elevation-2"
                                alt="User Image"
                            /> -->
                Logo
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}">
                    {{ config('app.name') }}
                </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
            >
                <li class="nav-item">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                    >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ __('common.dashboard') }}</p>
                    </a>
                </li>
                @role('admin')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                {{ __('user.admin') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a
                                    href="{{ route('admin.user.index') }}"
                                    class="nav-link {{ Route::is('admin.user.*') ? 'active' : '' }}"
                                >
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>{{ __('user.users') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    href="{{ route('admin.role.index') }}"
                                    class="nav-link {{ Route::is('admin.role.*') ? 'active' : '' }}"
                                >
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>{{ __('role.roles') }}</p>
                                </a>
                            </li>
                            <li class="nav-divider"></li>
                            <li class="nav-item">
                                <a
                                    href="{{ route('admin.permission.index') }}"
                                    class="nav-link {{ Route::is('admin.permission.*') ? 'active' : '' }}"
                                >
                                    <i class="nav-icon fas fa-hat-cowboy"></i>
                                    <p>{{ __('permission.permissions') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole
            </ul>
        </nav>
    </div>
</aside>
