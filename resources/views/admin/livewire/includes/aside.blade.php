<aside class="dashboard__aside">
    <div class="aside__brand">
        <img src="{{ asset('assets/img/logo/jeveline-icon.png') }}" alt="{{ trans('Website logo') }}">
        <span class="menu__text">{{ trans('Dashboard') }}</span>
    </div>

    <div class="aside__menu">
        <ul class="aside__menu-ul">
            <li>
                <a href="{{ route('admin.profile') }}" class="{{ Route::is('admin.profile') ? 'active' : '' }}">
                    <i class="menu__icon profile"></i>
                    <span class="menu__text">{{ trans('Profile') }}</span>
                </a>
            </li>
            <li>
                <small class="text-muted">{{ trans('Tables') }}</small>
            </li>
            <li>
                <a href="{{ route('admin.table.users') }}" class="{{ Route::is('admin.table.users') ? 'active' : '' }}">
                    <i class="menu__icon users"></i>
                    <span class="menu__text">{{ trans('Users') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.table.categories') }}"
                    class="{{ Route::is('admin.table.categories') ? 'active' : '' }}">
                    <i class="menu__icon categories"></i>
                    <span class="menu__text">{{ trans('Categories') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.table.tags') }}" class="{{ Route::is('admin.table.tags') ? 'active' : '' }}">
                    <i class="menu__icon tags"></i>
                    <span class="menu__text">{{ trans('Tags') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.table.posts') }}"
                    class="{{ Route::is('admin.table.posts') ? 'active' : '' }}">
                    <i class="menu__icon posts"></i>
                    <span class="menu__text">{{ trans('Posts') }}</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button>
                        <i class="menu__icon log-out"></i>
                        <span class="menu__text">{{ trans('Log out') }}</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
