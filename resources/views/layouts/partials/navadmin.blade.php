<header class="p-1 text-white">
  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="/admin/home">
        <img src="{{ asset('images/loboss.png') }}" alt="Logo">LOBOS BLANCOS UPVT
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>
      
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="/admin/home" class="nav-link px-2 text-white"><i class="fa-solid fa-house"></i> HOME</a></li>
              <li><a href="/admin/libros" class="nav-link px-2 text-white"><i class="fa-solid fa-book"></i> LIBROS</a></li>
              <li><a href="/admin/agregar-libro" class="nav-link px-2 text-white"><i class="fa-solid fa-plus"></i> AGREGAR LIBRO</a></li>
              <li><a href="/prestamos" class="nav-link px-2 text-white">PRÉSTAMOS</a></li>
              <li><a href="/configuracion" class="nav-link px-2 text-white">CONFIGURACIÓN</a></li>
            </ul>
      
            <!--form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
              <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
            </form-->
      
            @auth 
              <div class="text-end px-2">
                <a href="" class="btn btn-outline-light me-2"><i class="fa-regular fa-user"></i> {{auth()->user()->name}}</a>
                <a href="{{ route('logout.perform') }}" class="btn btn-outline-danger me-2"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
              </div>
            @endauth
      
            @guest
              <div class="text-end">
                <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
              </div>
            @endguest
          </div>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Botones añadidos en la parte inferior 
  <div class="text-center mt-3">
    <a href="/libros" class="btn btn-outline-light mx-2">LIBROS</a>
    <a href="/agregar-libro" class="btn btn-outline-light mx-2">AGREGAR LIBRO</a>
    <a href="/prestamos" class="btn btn-outline-light mx-2">PRÉSTAMOS</a>
    <a href="/configuracion" class="btn btn-outline-light mx-2">CONFIGURACIÓN</a>
</div>-->
</header>

<style>
  header {
    background-color: #7b2e49;
  }
  p {
    color: #22cb57e1;
  }
</style>
<style>
  
  .navbar-brand {
      color: white;
  }
  .navbar-brand img {
      width: 40px;
      margin-right: 10px;
  }

</style>
<style>
  .btn-outline-success {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
  }

  .btn-outline-success #mochila-icon {
      transition: stroke 0.3s ease;
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">