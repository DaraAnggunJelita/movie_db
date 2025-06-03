<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Movie DB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">

                {{-- Menu navigasi kiri hanya muncul setelah login --}}
                @auth
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link @yield('navHome')" aria-current="page" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('navMovie')" href="/movie">Movie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('navMosen')" href="/category">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('navProdi')" href="{{ route('movie.create') }}">Input Movie</a>
                    </li>
                </ul>
                @endauth

                <!-- Dropdown Logout di kanan -->
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login.form') }}" class="nav-link">Login</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
