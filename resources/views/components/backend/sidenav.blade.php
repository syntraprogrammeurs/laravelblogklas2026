<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>

            <a class="nav-link {{ request()->routeIs('backend.dashboard') ? 'active' : '' }}"
               href="{{ route('backend.dashboard') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Content</div>

            <a class="nav-link {{ request()->routeIs('backend.posts.*') ? 'active' : '' }}"
               href="{{ route('backend.posts.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-thumbtack"></i>
                </div>
                Posts
            </a>

            <a class="nav-link {{ request()->routeIs('backend.categories.*') ? 'active' : '' }}"
               href="{{ route('backend.categories.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-folder"></i>
                </div>
                Categories
            </a>

            <a class="nav-link {{ request()->routeIs('backend.media.*') ? 'active' : '' }}"
               href="{{ route('backend.media.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-image"></i>
                </div>
                Media
            </a>

            <div class="sb-sidenav-menu-heading">Administration</div>

            <a class="nav-link {{ request()->routeIs('backend.users.*') ? 'active' : '' }}"
               href="{{ route('backend.users.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-users"></i>
                </div>
                Users
            </a>

            <a class="nav-link {{ request()->routeIs('backend.roles.*') ? 'active' : '' }}"
               href="{{ route('backend.roles.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                Roles
            </a>

            <div class="sb-sidenav-menu-heading">Website</div>

            <a class="nav-link" href="{{ route('home') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-globe"></i>
                </div>
                Naar website
            </a>
        </div>
    </div>

    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ auth()->user()->name ?? 'Start Bootstrap' }}
    </div>
</nav>
