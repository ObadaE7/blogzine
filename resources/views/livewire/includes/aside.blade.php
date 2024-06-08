<aside class="dashboard__aside">
    <div class="aside__brand">
        <img src="{{ asset('assets/img/logo/jeveline-icon.png') }}" alt="{{ trans('Website logo') }}">
        <span class="menu__text">{{ trans('Dashboard') }}</span>
    </div>

    <div class="aside__menu">
        <ul class="aside__menu-ul">
            <li>
                <a href="{{ route('dashboard.profile') }}" class="{{ Route::is('dashboard.profile') ? 'active' : '' }}">
                    <i class="menu__icon profile"></i>
                    <span class="menu__text">{{ trans('Profile') }}</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="menu__icon analysis"></i>
                    <span class="menu__text">{{ trans('Analysis') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.post.index') }}"
                    class="{{ Route::is('dashboard.post.index') ? 'active' : '' }}">
                    <i class="menu__icon posts"></i>
                    <span class="menu__text">{{ trans('Posts') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.post.create') }}"
                    class="{{ Route::is('dashboard.post.create') ? 'active' : '' }}">
                    <i class="menu__icon create"></i>
                    <span class="menu__text">{{ trans('Create') }}</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn w-100 text-start">
                        <i class="menu__icon log-out"></i>
                        <span class="menu__text">{{ trans('Log out') }}</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
