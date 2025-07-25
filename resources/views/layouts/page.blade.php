<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/config/' . $config->_favicon) }}" type="image/png">
    <title>{{ config('_razonsocial', 'Alfa y Omega') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <style>
        body {
            /* Degradado azul */
            background: linear-gradient(to bottom right, #1d3557, #457b9d, #a8dadc);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            color: #000;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .badge {
            font-size: 0.7rem;
        }
    </style>
</head>
<body>
    <!-- Barra Superior -->
    <div class="container-fluid bg-primary text-white py-2 px-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="fw-bold fs-5">
                <a href="/" class="text-white text-decoration-none">{{ config('_razonsocial', 'Alfa y Omega') }}</a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="/store/cart-checkout" class="text-white position-relative d-flex align-items-center text-decoration-none">
                    <i class="bi bi-cart me-1"></i>
                    <span>Carrito</span>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ Cart::getContent()->count() }}
                    </span>
                </a>

                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar sesión
                    </a>
                @else
                    <span class="me-2 d-none d-md-inline">
                        <i class="bi bi-person-fill me-1"></i>{{ Auth::user()->name }}
                    </span>
                    <a href="{{ route('logout') }}" class="btn btn-light btn-sm text-primary fw-bold"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-1"></i> Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @endguest
            </div>
        </div>
    </div>

    <!-- Logo centrado -->
    <div class="text-center my-4">
        <a href="/">
            <img src="/img/config/{{$config->_logo}}" alt="Logo {{$config->_razonsocial}}" height="80" />
        </a>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-info shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="{{ url('/') }}">{{ config('_razonsocial', 'Alfa y Omega') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="/">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fw-bold" href="#" data-bs-toggle="dropdown">
                            Productos
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($menu as $i)
                                <li><a class="dropdown-item fw-semibold" href="/{{$i->slug}}">{{$i->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link text-white fw-bold" href="/empresa">Empresa</a></li>
                    <li class="nav-item"><a class="nav-link text-white fw-bold" href="/contacto">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link text-white fw-bold" href="/blog">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container py-5">
        <div class="bg-white shadow-sm rounded-4 p-4">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer style="background-color: #1d3557;" class="text-light pt-5">
        <div class="container">
            <div class="row gy-4 text-center text-md-start">

                <!-- Logo -->
                <div class="col-md-3">
                    <img src="/img/config/{{$config->_logo}}" height="60" alt="Logo" class="mb-2" />
                    <p class="small text-light mt-2">{{ $config->_razonsocial }}</p>
                </div>

                <!-- Enlaces -->
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Enlaces útiles</h6>
                    <ul class="list-unstyled">
                        <li><a href="/empresa" class="text-light text-decoration-none">Empresa</a></li>
                        <li><a href="/contacto" class="text-light text-decoration-none">Contacto</a></li>
                        <li><a href="/blog" class="text-light text-decoration-none">Blog</a></li>
                    </ul>
                </div>

                <!-- Contacto -->
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Contáctanos</h6>
                    <ul class="list-unstyled small text-light">
                        <li><i class="bi bi-envelope-fill me-2"></i>{{ $config->_email }}</li>
                        <li><i class="bi bi-geo-alt-fill me-2"></i>{{ $config->_direccion }}</li>
                        <li><i class="bi bi-phone-fill me-2"></i>{{ $config->_celular }}</li>
                    </ul>
                </div>
            </div>

            <!-- Derechos -->
            <div class="text-center border-top border-secondary pt-3 mt-4 small text-light">
                &copy; 2025 {{ $config->_razonsocial }}. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle con Popper (JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
