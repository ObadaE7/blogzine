<header class="dashboard__main-header">
    <button class="aside__toggle" onclick="toggleSidebar()">
        <svg class="ham hamRotate ham8" viewBox="0 0 100 100" width="40" onclick="this.classList.toggle('active')">
            <path class="line top"
                d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20" />
            <path class="line middle" d="m 30,50 h 40" />
            <path class="line bottom"
                d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20" />
        </svg>
    </button>

    <div class="header__menu">
        <ul class="header__menu-ul">
            <li>
                <div class="dropdown">
                    <button class="li__btn language" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false"></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Arabic</a></li>
                        <li><a class="dropdown-item" href="#">English</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <button class="li__btn notifications" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><span class="li__btn-badge">0</span></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <button class="li__btn messages" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><span class="li__btn-badge messages">0</span></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <button class="li__btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="avatar" alt="{{ trans('Profile avatar') }}"
                            src="{{ isset(auth()->user()->avatar) ? asset('storage/' . auth()->user()->avatar) : asset('assets/img/avatar.jpg') }}">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Setting</a></li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li><a class="dropdown-item" href="#">Log out</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</header>
