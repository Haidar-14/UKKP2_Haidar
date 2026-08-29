<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Resto App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            width: 250px;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }

        .sidebar .nav-link {
            color: #ced4da;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background-color: #495057;
        }

        .sidebar .nav-link.active {
            color: #fff;
            background-color: #0d6efd;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            background-color: #fff;
            padding: 10px 20px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card {
            border-radius: 6px;
            border: 1px solid #dee2e6;
        }

        .card-header {
            background-color: #f8f9fa;
            font-weight: 600;
            border-bottom: 1px solid #dee2e6;
        }

        .table thead th {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <div class="sidebar d-flex flex-column">
        <div class="text-center mb-4">
            <h5 class="text-white">Tester</h5>
            <small class="text-secondary">
                @if (Auth::user()->role === 'admin')

                @endif
            </small>
        </div>
        <ul class="nav flex-column">
            @if (Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.user.index') ? 'active' : '' }}"
                        href="{{ route('admin.user.index') }}">
                        <i class="bi bi-people"></i> Kelola User
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}"
                        href="{{ route('admin.laporan.index') }}">
                        <i class="bi bi-file-earmark-text"></i> Semua Laporan
                    </a>
                </li>
            @elseif (Auth::user()->role === 'petugas')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}"
                        href="{{ route('petugas.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.user.index') ? 'active' : '' }}"
                        href="{{ route('admin.user.index') }}">
                        <i class="bi bi-people"></i> Kelola User
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                        href="{{ route('user.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.laporan.index') ? 'active' : '' }}"
                        href="{{ route('user.laporan.index') }}">
                        <i class="bi bi-file-earmark-text"></i> Laporan Saya
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <div class="content">
        <div class="topbar">
            <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
            <div class="d-flex align-items-center">
                <span class="me-3">Halo, {{ Auth::user()->nama }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>