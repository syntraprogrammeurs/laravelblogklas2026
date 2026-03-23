@php
    $user = auth()->user();
    $avatar = $user?->media()->first();

    $avatarUrl = null;

    if ($avatar && method_exists($avatar, 'url')) {
        $avatarUrl = $avatar->url();
    }

    $brandUrl = $user && $user->can('view-backend-dashboard')
        ? route('backend.dashboard')
        : route('backend.posts.index');
@endphp

<nav class="sb-topnav navbar navbar-expand">
    <a class="navbar-brand d-flex align-items-center gap-3 ps-3 fw-semibold" href="{{ $brandUrl }}">
        <span class="d-inline-flex align-items-center justify-content-center rounded-4"
              style="width: 44px; height: 44px; background: linear-gradient(135deg, rgba(56,189,248,0.95), rgba(236,72,153,0.88)); box-shadow: 0 12px 30px rgba(15,23,42,0.18);">
            <i class="fas fa-layer-group"></i>
        </span>
        <span>
            <span class="d-block" style="font-size: 1.05rem; line-height: 1;">Backend Studio</span>
            <span class="d-block small opacity-75 mt-1">Glass dashboard</span>
        </span>
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 me-lg-4" id="sidebarToggle" type="button">
        <i class="fas fa-bars"></i>
    </button>

    <form class="d-none d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input
                class="form-control"
                type="text"
                placeholder="Search backend content..."
                aria-label="Search backend content"
                aria-describedby="btnNavbarSearch"
            />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a
                class="nav-link dropdown-toggle d-flex align-items-center gap-3"
                id="navbarDropdown"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                <span class="text-end d-none d-sm-block">
                    <span class="d-block fw-semibold">{{ $user->name ?? 'Gebruiker' }}</span>
                    <span class="d-block small opacity-75">Account</span>
                </span>

                @if ($avatarUrl)
                    <img
                        src="{{ $avatarUrl }}"
                        alt="{{ $user->name ?? 'Gebruiker' }}"
                        class="rounded-circle"
                        style="width: 42px; height: 42px; object-fit: cover;"
                    >
                @else
                    <span
                        class="d-inline-flex align-items-center justify-content-center rounded-circle"
                        style="width: 42px; height: 42px; background: rgba(255,255,255,0.16); border: 1px solid rgba(255,255,255,0.20);"
                    >
                        <i class="fas fa-user"></i>
                    </span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="fas fa-gear me-2"></i> Settings
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('home') }}">
                        <i class="fas fa-globe me-2"></i> Website
                    </a>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-right-from-bracket me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
