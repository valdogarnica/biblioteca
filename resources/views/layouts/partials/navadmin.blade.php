<header>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #7b2e49;">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="/admin/home">
        <img src="{{ asset('images/loboss.png') }}" alt="Logo" style="width: 40px; margin-right: 10px;">LOBOS BLANCOS UPVT
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link text-white" href="/admin/home">
              <i class="fa-solid fa-house"></i> HOME
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/admin/libros/devueltos">
              <i class="fa-solid fa-book"></i> LIBROS DEVUELTOS
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/admin/agregar-libro">
              <i class="fa-solid fa-plus"></i> AGREGAR LIBRO
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/admin/prestamos">
              <i class="fa-solid fa-handshake"></i> PRÉSTAMOS
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/admin/inventario">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                <path d="M3 16H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M2 22L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M3 9H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M3 22V8C3 5.17157 3 3.75736 3.93037 2.87868C4.86073 2 6.35814 2 9.35294 2H14.6471C17.6419 2 19.1393 2 20.0696 2.87868C21 3.75736 21 5.17157 21 8V22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11 19H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M10 9L9 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M6.5 9V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M14 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 9V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M16 16L17 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M19 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg> INVENTARIO
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/admin/configuracion">
              <i class="fa-solid fa-gear"></i> CONFIGURACIÓN
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          @auth
          <li class="nav-item d-flex align-items-center">
            <a href="" class="btn btn-outline-light me-2"><i class="fa-regular fa-user"></i> Admin: {{auth()->user()->name}}</a>
            <a href="{{ route('logout.perform') }}" class="btn btn-outline-danger me-2"><i class="fa-solid fa-arrow-right-from-bracket"></i> Salir</a>
          </li>
          @endauth
          @guest
          <li class="nav-item">
            <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- Botones añadidos en la parte inferior para dispositivos pequeños -->
  <div class="text-center mt-1 d-lg-none">
    <a href="/admin/home" class="btn btn-outline-light mx-2">
      <i class="fa-solid fa-house"></i> HOME
    </a>
    <a href="/admin/libros" class="btn btn-outline-light mx-2">
      <i class="fa-solid fa-book"></i> LIBROS DEVUELTOS
    </a>
    <a href="/admin/agregar-libro" class="btn btn-outline-light mx-2">AGREGAR LIBRO</a>
    <a href="/admin/prestamos" class="btn btn-outline-light mx-2">
      <i class="fa-solid fa-handshake"></i> PRÉSTAMOS
    </a>
    <a href="/admin/configuracion" class="btn btn-outline-light mx-2">
      <i class="fa-solid fa-gear"></i> CONFIGURACIÓN
    </a>
  </div>
</header>

<style>
  .btn-outline-light, .btn-warning, .btn-outline-danger {
    margin-top: 5px;
    margin-bottom: 5px;
  }

  .text-center a {
    margin-top: 10px;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
