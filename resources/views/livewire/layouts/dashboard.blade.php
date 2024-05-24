<x-app-layout>
    <div class="dashboard-wrapper">
        <aside class="dash-aside">
            <ul class="navbar-nav">
                <li><span class="text-placeholder">Main</span></li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="nav-link-icon">
                            <i class="bi bi-person-lines-fill me-2"></i>
                        </div>
                        <div class="nav-link-text">
                            <span>Profile</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="nav-link-icon">
                            <i class="bi bi-pie-chart-fill me-2"></i>
                        </div>
                        <div class="nav-link-text">
                            <span>Analysis</span>
                        </div>
                    </a>
                </li>

                <li>
                    <hr>
                    <span class="text-placeholder">Post section</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="nav-link-icon">
                            <i class="bi bi-stickies-fill me-2"></i>
                        </div>
                        <div class="nav-link-text">
                            <span>Posts</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.create.post') }}">
                        <div class="nav-link-icon">
                            <i class="bi bi-file-earmark-plus-fill me-2"></i>
                        </div>
                        <div class="nav-link-text">
                            <span>Create</span>
                        </div>
                    </a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link">
                            <div class="nav-link-icon">
                                <i class="bi bi-door-open-fill me-2"></i>
                            </div>
                            <div class="nav-link-text">
                                Log out
                            </div>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <main class="dash-content">
            @yield('content')
        </main>
    </div>
</x-app-layout>
