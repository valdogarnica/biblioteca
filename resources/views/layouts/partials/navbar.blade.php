<header class="p-1 text-white">
  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="/home">
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
      
            <!--ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
              <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
              <li><a href="#" class="nav-link px-2 text-white">About</a></li>
            </ul-->
      
            <!--form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
              <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
            </form-->
      
            @auth 
              <div class="text-end px-2">
                <a href="/mochila/{{ auth()->user()->username }}" class="btn btn-outline-success me-2">
                  <!-- Ícono de Mochila en SVG -->
                  <svg id="mochila-icon" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                    <rect fill="none" height="256" width="256"/>
                    <path d="M96,48h64a48,48,0,0,1,48,48V216a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V96A48,48,0,0,1,96,48Z" 
                          fill="none" stroke="green" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/>
                    <path d="M80,224V152a16,16,0,0,1,16-16h64a16,16,0,0,1,16,16v72" 
                          fill="none" stroke="green" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/>
                    <path d="M96,48V32a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V48" 
                          fill="none" stroke="green" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"/>
                    <line fill="none" stroke="green" stroke-linecap="round" stroke-linejoin="round" stroke-width="8" x1="112" x2="144" y1="88" y2="88"/>
                    <line fill="none" stroke="green" stroke-linecap="round" stroke-linejoin="round" stroke-width="8" x1="80" x2="176" y1="168" y2="168"/>
                    <line fill="none" stroke="green" stroke-linecap="round" stroke-linejoin="round" stroke-width="8" x1="144" x2="144" y1="168" y2="184"/>
                  </svg>
                   Mochila
                </a>
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