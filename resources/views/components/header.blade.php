<header class="wrapper__header">
    <div class="header__brand">
        <img src="{{ asset('assets/img/logo/jeveline-logo-dark.png') }}" class="header__brand-img"
            alt="{{ trans('Website logo') }}">
    </div>
    <div class="header__menu">
        <ul class="header__menu-ul">
            <li><a href="{{ route('home') }}" class="underline__hover">{{ trans('HOME') }}</a></li>
            <li><a href="{{ route('categories') }}" class="underline__hover">{{ trans('CATEGORIES') }}</a></li>
            <li><a href="{{ route('posts') }}" class="underline__hover">{{ trans('POSTS') }}</a></li>
            @auth
                <li>
                    <a href="{{ route('dashboard.dashboard') }}"
                        class="underline__hover text-primary">{{ trans('DASHBOARD') }}
                    </a>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="underline__hover">{{ trans('LOGIN') }}</a></li>
            @endauth
        </ul>
    </div>
    <div class="header__search">
        <input type="search" name="search" class="form-control" placeholder="{{ trans('Search here') }}">
        <i class="header__search-icon"></i>
    </div>
    <button class="header__hamburger" data-bs-toggle="offcanvas" data-bs-target="#headerToggle">
        <div class="header__hamburger-icon">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </button>
</header>

<div class="offcanvas offcanvas-end" tabindex="-1" id="headerToggle" aria-labelledby="headerToggleLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close m-0" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if (Route::is('home'))
            <div class="header__search-sm">
                <input type="search" name="search" class="form-control" placeholder="{{ trans('Search here') }}"><i
                    class="header__search-icon"></i>
            </div>
        @endif
        <ul class="header__offcanvas-ul">
            <li><a href="{{ route('home') }}"><i class="bi bi-house-door"></i>{{ trans('HOME') }}</a></li>
            <li><a href="{{ route('categories') }}"><i class="bi bi-columns-gap"></i>{{ trans('CATEGORIES') }}</a>
            </li>
            <li><a href="{{ route('posts') }}"><i class="bi bi-stickies"></i>{{ trans('POSTS') }}</a></li>
            @auth
                <li>
                    <a href="{{ route('dashboard.dashboard') }}">
                        <i class="bi bi-speedometer"></i>{{ trans('DASHBOARD') }}
                    </a>
                </li>
            @else
                <li><a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i>{{ trans('LOGIN') }}</a></li>
            @endauth
        </ul>
    </div>
</div>
