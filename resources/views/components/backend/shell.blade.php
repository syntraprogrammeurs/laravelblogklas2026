<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>{{ $title ?? 'Dashboard' }}</title>

    @vite(['resources/css/styles.css', 'resources/js/app.js'])

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.12);
            --glass-bg-strong: rgba(255, 255, 255, 0.18);
            --glass-border: rgba(255, 255, 255, 0.24);
            --glass-text: #f8fbff;
            --glass-muted: rgba(248, 251, 255, 0.72);
            --glass-shadow: 0 18px 50px rgba(15, 23, 42, 0.20);
            --glass-shadow-soft: 0 12px 36px rgba(15, 23, 42, 0.14);
            --glass-gradient: linear-gradient(135deg, #ef91d6 0%, #c8b4ff 38%, #9ed8ff 100%);
            --accent-gradient: linear-gradient(135deg, #38bdf8 0%, #8b5cf6 50%, #ec4899 100%);
            --accent-gradient-soft: linear-gradient(135deg, rgba(56, 189, 248, 0.22) 0%, rgba(139, 92, 246, 0.24) 50%, rgba(236, 72, 153, 0.24) 100%);
        }

        * { scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.35) transparent; }
        *::-webkit-scrollbar { width: 10px; height: 10px; }
        *::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.28); border-radius: 999px; }
        *::-webkit-scrollbar-track { background: transparent; }

        body.backend-glass {
            min-height: 100vh;
            color: var(--glass-text);
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.28), transparent 34%),
                radial-gradient(circle at top right, rgba(153,246,228,0.22), transparent 28%),
                radial-gradient(circle at bottom left, rgba(129,140,248,0.22), transparent 28%),
                linear-gradient(135deg, #eb8fca 0%, #bea8f7 42%, #9ad8ff 100%);
            background-attachment: fixed;
        }

        body.backend-glass::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            backdrop-filter: blur(2px);
            background: linear-gradient(180deg, rgba(255,255,255,0.10), rgba(255,255,255,0.04));
        }

        a { color: #fefcff; }
        a:hover { color: #ffffff; }
        main { position: relative; z-index: 1; }

        .glass-shell {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            padding-top: 6.25rem;
        }

        .glass-panel,
        .card,
        .dropdown-menu,
        .sb-sidenav,
        .sb-topnav,
        footer,
        .pagination .page-link,
        .form-control,
        .form-select,
        textarea.form-control,
        table,
        .alert {
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .sb-topnav {
            background: rgba(255,255,255,0.10) !important;
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: var(--glass-shadow-soft);
            border-radius: 0 0 28px 28px;
            margin: 0.75rem 1rem 0;
            min-height: 74px;
            padding-inline: 0.75rem;
        }

        .sb-topnav .navbar-brand,
        .sb-topnav .nav-link,
        .sb-topnav .btn,
        .sb-topnav .dropdown-toggle,
        .sb-topnav .text-white {
            color: var(--glass-text) !important;
        }

        .sb-topnav .form-control {
            min-width: 280px;
        }

        #layoutSidenav {
            display: flex;
            gap: 1.5rem;
            padding: 1rem;
        }

        #layoutSidenav_nav {
            flex: 0 0 300px;
            width: 300px;
        }

        #layoutSidenav_content {
            min-width: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sb-sidenav {
            background: rgba(255,255,255,0.10) !important;
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: var(--glass-shadow-soft);
            border-radius: 2rem;
            overflow: hidden;
            color: var(--glass-text);
            min-height: calc(100vh - 8rem);
            position: sticky;
            top: 6.75rem;
        }

        .sb-sidenav .sb-sidenav-menu,
        .sb-sidenav .sb-sidenav-footer {
            background: transparent !important;
            color: var(--glass-text);
        }

        .sb-sidenav .nav-link {
            margin: 0.28rem 0.9rem;
            border-radius: 1rem;
            color: var(--glass-muted);
            padding: 0.9rem 1rem;
            transition: 180ms ease;
        }

        .sb-sidenav .nav-link:hover,
        .sb-sidenav .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, rgba(56,189,248,0.22), rgba(236,72,153,0.18));
            border: 1px solid rgba(255,255,255,0.16);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.10);
        }

        .sb-sidenav-menu-heading {
            color: rgba(255,255,255,0.52) !important;
            font-size: 0.72rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            margin: 1.25rem 1.25rem 0.5rem;
        }

        .sb-sidenav-footer {
            border-top: 1px solid rgba(255,255,255,0.12);
            padding: 1rem 1.25rem;
        }

        .container-fluid.px-4.pt-4 {
            padding-inline: 0 !important;
            padding-top: 0 !important;
        }

        .backend-page-header {
            display: flex;
            flex-wrap: wrap;
            align-items: end;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1.4rem 1.5rem;
            border-radius: 2rem;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: var(--glass-shadow-soft);
        }

        .backend-page-title {
            margin: 0;
            font-size: clamp(1.8rem, 2vw, 2.5rem);
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .backend-page-meta {
            color: var(--glass-muted);
            font-size: 0.95rem;
        }

        .backend-page-stack > * + * {
            margin-top: 1.5rem;
        }

        form.mb-4,
        .ui-filter-panel {
            padding: 1.25rem;
            border-radius: 1.75rem;
            background: rgba(255,255,255,0.09);
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: var(--glass-shadow-soft);
        }

        .card {
            background: rgba(255,255,255,0.10) !important;
            border: 1px solid rgba(255,255,255,0.20) !important;
            border-radius: 1.75rem !important;
            box-shadow: var(--glass-shadow) !important;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, rgba(255,255,255,0.14), rgba(255,255,255,0.08)) !important;
            border-bottom: 1px solid rgba(255,255,255,0.14) !important;
            color: var(--glass-text);
            font-weight: 600;
            padding: 1rem 1.25rem;
        }

        .card-body,
        .card-footer {
            background: transparent !important;
            color: var(--glass-text);
            padding: 1.25rem;
        }

        .text-muted,
        .small,
        .form-text,
        .breadcrumb-item,
        .table,
        .table th,
        .table td,
        .dropdown-item-text {
            color: var(--glass-muted) !important;
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-color: var(--glass-text);
            --bs-table-striped-bg: rgba(255,255,255,0.05);
            --bs-table-striped-color: var(--glass-text);
            --bs-table-hover-bg: rgba(255,255,255,0.08);
            --bs-table-hover-color: var(--glass-text);
            --bs-table-border-color: rgba(255,255,255,0.12);
            margin-bottom: 0;
        }

        .table > :not(caption) > * > * {
            background: transparent !important;
            border-bottom-color: rgba(255,255,255,0.10) !important;
            vertical-align: middle;
        }

        .table a {
            color: #ffffff;
        }

        .form-label {
            color: rgba(255,255,255,0.88);
            font-weight: 600;
            margin-bottom: 0.45rem;
        }

        .form-control,
        .form-select {
            background: rgba(255,255,255,0.12) !important;
            border: 1px solid rgba(255,255,255,0.18) !important;
            color: var(--glass-text) !important;
            border-radius: 1rem !important;
            min-height: 46px;
            box-shadow: none !important;
        }

        textarea.form-control {
            min-height: 120px;
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.48);
        }

        .form-control:focus,
        .form-select:focus,
        .btn:focus,
        .page-link:focus {
            border-color: rgba(255,255,255,0.34) !important;
            box-shadow: 0 0 0 0.24rem rgba(255,255,255,0.10) !important;
        }

        .form-check-input {
            background-color: rgba(255,255,255,0.12);
            border-color: rgba(255,255,255,0.22);
        }

        .form-check-input:checked {
            background-color: #8b5cf6;
            border-color: #8b5cf6;
        }

        .form-check-label,
        .form-check { color: var(--glass-text); }

        .btn {
            border-radius: 999px !important;
            padding: 0.7rem 1.15rem !important;
            font-weight: 600 !important;
            border: 1px solid rgba(255,255,255,0.18) !important;
            transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease !important;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.16);
        }

        .btn-primary,
        .btn-success,
        .btn-danger,
        .btn-warning,
        .btn-info {
            background: var(--accent-gradient) !important;
            color: #fff !important;
        }

        .btn-outline-secondary,
        .btn-outline-primary,
        .btn-outline-danger,
        .btn-outline-success,
        .btn-secondary,
        .btn-light,
        .btn-link {
            background: rgba(255,255,255,0.10) !important;
            color: #fff !important;
        }

        .badge {
            border-radius: 999px;
            padding: 0.45rem 0.7rem;
            font-weight: 600;
            border: 1px solid rgba(255,255,255,0.12);
        }

        .bg-success, .badge.bg-success { background: rgba(34,197,94,0.28) !important; }
        .bg-danger, .badge.bg-danger { background: rgba(244,63,94,0.28) !important; }
        .bg-warning, .badge.bg-warning { background: rgba(245,158,11,0.28) !important; color: #fff !important; }
        .bg-info, .badge.bg-info, .bg-primary, .badge.bg-primary, .bg-secondary, .badge.bg-secondary { background: rgba(96,165,250,0.24) !important; }

        .alert {
            background: rgba(255,255,255,0.14) !important;
            border: 1px solid rgba(255,255,255,0.18) !important;
            border-radius: 1.25rem !important;
            color: #fff !important;
            box-shadow: var(--glass-shadow-soft);
        }

        .dropdown-menu {
            background: rgba(255,255,255,0.16) !important;
            border: 1px solid rgba(255,255,255,0.18) !important;
            border-radius: 1rem !important;
            box-shadow: var(--glass-shadow-soft);
            overflow: hidden;
        }

        .dropdown-item {
            color: var(--glass-text) !important;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background: rgba(255,255,255,0.12) !important;
        }

        .dropdown-divider,
        hr {
            border-color: rgba(255,255,255,0.12) !important;
            opacity: 1;
        }

        .pagination {
            gap: 0.5rem;
        }

        .pagination .page-link {
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.16);
            color: #fff;
            border-radius: 999px;
            min-width: 42px;
            text-align: center;
        }

        .pagination .active > .page-link,
        .pagination .page-link.active {
            background: var(--accent-gradient);
            border-color: transparent;
        }

        .img-thumbnail,
        .img-fluid.rounded,
        img.rounded-circle {
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.18) !important;
            box-shadow: var(--glass-shadow-soft);
        }

        footer.py-4 {
            background: rgba(255,255,255,0.08) !important;
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 1.5rem;
            margin-top: 1.5rem;
            box-shadow: var(--glass-shadow-soft);
        }

        @media (max-width: 1199.98px) {
            #layoutSidenav { gap: 1rem; }
            #layoutSidenav_nav { flex-basis: 272px; width: 272px; }
        }

        @media (max-width: 991.98px) {
            .sb-topnav { margin-inline: 0.75rem; border-radius: 1.5rem; }
            #layoutSidenav { flex-direction: column; }
            #layoutSidenav_nav { width: 100%; flex-basis: auto; }
            .sb-sidenav { position: static; min-height: auto; }
        }
    </style>

    {{ $head ?? '' }}
</head>

<body class="sb-nav-fixed backend-glass">
<div class="glass-shell">
    <x-backend.topnav />

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <x-backend.sidenav />
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 pt-4">
                    <x-backend.flash />
                    {{ $slot }}
                </div>
            </main>

            <x-backend.footer />
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('sidebarToggle');
        const nav = document.getElementById('layoutSidenav_nav');

        if (toggle && nav) {
            toggle.addEventListener('click', function () {
                if (window.innerWidth <= 991) {
                    nav.classList.toggle('d-none');
                }
            });
        }
    });
</script>

{{ $scripts ?? '' }}
</body>
</html>
