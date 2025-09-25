<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Flat Bill Management' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Multi-Tenant Billing</a>
            <div class="ms-auto d-flex align-items-center">
                @auth
                    <span class="navbar-text me-3">Welcome, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                    <a class="btn btn-outline-light btn-sm me-2" href="{{ route('dashboard') }}">Dashboard</a>
                    <button id="themeToggle" type="button" class="btn btn-outline-light btn-sm me-2" aria-label="Toggle theme">Toggle theme</button>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @else
                    <button id="themeToggle" type="button" class="btn btn-outline-light btn-sm me-2" aria-label="Toggle theme">Toggle theme</button>
                    <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    @if (request()->routeIs('login'))
        <main class="container">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @yield('content')
        </main>
    @else
        <div class="container-fluid">
            <div class="row">
                <aside class="col-12 col-md-3 col-lg-2 mb-4 mb-md-0">
                    <div class="list-group">
                        <a href="{{ route('home') }}" class="list-group-item list-group-item-action">Home</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.owners.index') }}" class="list-group-item list-group-item-action">Owners</a>
                                <a href="{{ route('admin.tenants.index') }}" class="list-group-item list-group-item-action">Tenants</a>
                            @else
                                <a href="{{ route('owner.flats.index') }}" class="list-group-item list-group-item-action">Flats</a>
                                <a href="{{ route('owner.bills.index') }}" class="list-group-item list-group-item-action">Bills</a>
                                <a href="{{ route('owner.categories.index') }}" class="list-group-item list-group-item-action">Categories</a>
                            @endif
                        @endauth
                    </div>
                </aside>
                <main class="col-12 col-md-9 col-lg-10">
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    @endif
    <script>
    (function () {
        var docEl = document.documentElement;
        function getPreferredTheme() {
            var stored = localStorage.getItem('theme');
            if (stored === 'light' || stored === 'dark') return stored;
            return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        function applyTheme(theme) {
            docEl.setAttribute('data-bs-theme', theme);
        }
        function toggleTheme() {
            var current = docEl.getAttribute('data-bs-theme') || getPreferredTheme();
            var next = current === 'dark' ? 'light' : 'dark';
            localStorage.setItem('theme', next);
            applyTheme(next);
        }
        // Initial
        applyTheme(getPreferredTheme());
        // React to system changes only if no manual override
        if (window.matchMedia) {
            var media = window.matchMedia('(prefers-color-scheme: dark)');
            media.addEventListener && media.addEventListener('change', function () {
                if (!localStorage.getItem('theme')) {
                    applyTheme(getPreferredTheme());
                }
            });
        }
        // Hook up toggle button
        var btn = document.getElementById('themeToggle');
        if (btn) {
            btn.addEventListener('click', toggleTheme);
        }
    })();
    </script>
</body>
</html>

