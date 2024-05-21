<header class="header">
    <div class="brand">
        <img src="{{ asset('assets/img/logo/logo.svg') }}" class="brand-img" alt="Website logo">
    </div>
    <div class="menu">
        <ul class="menu-ul">
            <li><a href="#">Home</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="#">Posts</a></li>
            <li><a href="#">Login</a></li>
        </ul>
    </div>
    <div class="search">
        <input type="search" name="search" id="search" class="form-control form-control-sm"
            placeholder="Search here">
        <div class="search-icon"><i class="bi bi-search"></i></div>
    </div>

    <button class="header-toggle" data-bs-toggle="offcanvas" data-bs-target="#headerToggle">
        <i class="bi bi-list"></i>
    </button>
</header>

<div class="offcanvas offcanvas-end" tabindex="-1" id="headerToggle" aria-labelledby="headerToggleLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close m-0" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="search-menu-sm">
            <input type="search" name="search" id="search" class="form-control" placeholder="Search here">
            <div class="search-icon"><i class="bi bi-search"></i></div>
        </div>
        <ul class="offcanvas-menu-ul">
            <li><a href="#"><i class="bi bi-house-door"></i>Home</a></li>
            <li><a href="#"><i class="bi bi-columns-gap"></i>Categories</a></li>
            <li><a href="#"><i class="bi bi-stickies"></i>Posts</a></li>
            <li><a href="#"><i class="bi bi-box-arrow-in-right"></i>Login</a></li>
        </ul>
    </div>
</div>
