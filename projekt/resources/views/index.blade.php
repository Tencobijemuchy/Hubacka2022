@extends('layouts.app')


@section('content')
  <!-- navbar with logo and account button, logo -->
  <nav class="navbar navbar-expand-sm navbar-light mb-2" style="background-color: #80a080;">
      <div class="container d-flex align-items-center justify-content-between flex-nowrap">
          <div class="d-flex align-items-center flex-nowrap">
              <a href="{{ route('index') }}" class="me-3">
                  <img class="img-fluid" style="width:60px;" src="{{ asset('assets/images/logo.svg') }}" alt="logo">
              </a>
              <h1 class="mb-0 fs-4">
                  <a href="{{ route('index') }}" class="text-dark text-decoration-none">LukEshop</a>
              </h1>
          </div>
          <div>
          </div>
          <div class="d-flex align-items-center flex-nowrap">


            <div class="dropdown">
                  @if(auth()->check())
                      <button class="btn btn-secondary me-3 px-4 dropdown-toggle no-caret" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                          {{ auth()->user()->username }}
                      </button>

                      <ul class="dropdown-menu" aria-labelledby="userDropdown">
                          <li>
                              <form action="{{ route('logout') }}" method="POST">
                                  @csrf
                                  <button type="submit" class="dropdown-item">Logout</button>
                              </form>
                          </li>
                      </ul>
                  @else
                      <button class="btn btn-secondary me-3 px-4" disabled>guest</button>
                  @endif
              </div>
              <h1 class="ms-3">
                @if(auth()->check())
                    <a href="#" class="text-dark"><i class="bi bi-file-person"></i></a>
                @else
                    <a href="{{ route('login') }}" class="text-dark"><i class="bi bi-person-lock"></i></a>
                @endif
              </h1>
          </div>
      </div>
  </nav>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="container">
                <span class="fs-5">
                <i class="bi bi-check-circle-fill px-2"></i>
                {{ session('success') }}
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- search box and shopping cart icon -->
    <div style="background-color: #80a080;" class="container d-flex align-items-center justify-content-between rounded-2 shadow">
        <form action="{{ route('searchFilter') }}" method="GET" class="flex-grow-1 d-flex justify-content-center ps-5">
            <div class="py-2 d-flex w-100" style="max-width: 700px;">
                <input type="text" name="name" value="{{ request('name') }}" class="form-control me-2" placeholder="Search box" />
                <button type="submit" class="btn btn-success"><i class="bi bi-search fs-5"></i></button>
            </div>
        </form>

        <div>
            <h2 class="mb-0 px-1">
                <a href="{{ route('shoppingCart') }}" class="text-dark">
                    <i class="bi bi-bag-fill"></i>
                </a>
            </h2>
        </div>
    </div>

  <!-- quick select -->
  <div style="background-color: #80a080;" class="container rounded-2 p-3 mt-2 shadow">
    <div class="row g-3">
      <div class="col-6 col-md">
          <a type="button" class="btn btn-light w-100" href="{{ route('searchFilter', 1) }}">Luky</a>
      </div>
      <div class="col-6 col-md">
        <a type="button" class="btn btn-light w-100" href="{{ route('searchFilter',2) }}">Kuše</a>
      </div>
      <div class="col-6 col-md">
        <a type="button" class="btn btn-light w-100" href="{{ route('searchFilter',3) }}">Praky</a>
      </div>
      <div class="col-6 col-md">
        <a type="button" class="btn btn-light w-100" href="{{ route('searchFilter',4) }}">Šípy</a>
      </div>
      <div class="col-6 col-md">
        <a type="button" class="btn btn-light w-100" href="{{ route('searchFilter',5) }}">Príslušenstvo</a>
      </div>
    </div>
  </div>

  <!-- carousel -->
  <div class="container rounded-2 p-2 pt-4 my-2 shadow" style="background-color: #80a080;">
      <div id="carouselExampleAutoplaying" class="carousel carousel-dark slide" data-bs-ride="carousel">

          <div class="carousel-inner">

              <div class="carousel-item active" data-bs-interval="4000">
                  <div class="d-flex flex-column flex-md-row align-items-center">
                      <div class="col-md-6 d-flex justify-content-center align-items-center" style="opacity: 0.9; filter: brightness(0.8);">
                          <img src="assets/images/MainPageCarousel/real1.png" class="img-fluid w-75 rounded shadow-lg" alt="...">
                      </div>
                      <div class="col-md-5 text-center text-md-start">
                          <h5>Rekreácia a zábavná aktivita</h5>
                          <p>Rekreačná lukostreľba zlepšuje sústredenie a znižuje stres — už 30 minút týždenne na strelnici môže zlepšiť duševnú pohodu.</p>
                      </div>
                  </div>
              </div>

              <div class="carousel-item" data-bs-interval="4000">
                  <div class="d-flex flex-column flex-md-row align-items-center">
                      <div class="col-md-6 d-flex justify-content-center align-items-center" style="opacity: 0.9; filter: brightness(0.8);">
                          <img src="assets/images/MainPageCarousel/real2.jpg" class="img-fluid w-75 rounded shadow-lg" alt="...">
                      </div>
                      <div class="col-md-5 text-center text-md-start">
                          <h5>Lov</h5>
                          <p>Lov lukom je jednou z najtichších foriem lovu – vďaka tomu sa lovec môže priblížiť k zveri bez vyplašenia a s minimálnym dopadom na prírodu.</p>
                      </div>
                  </div>
              </div>

              <div class="carousel-item" data-bs-interval="4000">
                  <div class="d-flex flex-column flex-md-row align-items-center">
                      <div class="col-md-6 d-flex justify-content-center align-items-center" style="opacity: 0.9; filter: brightness(0.8);">
                          <img src="assets/images/MainPageCarousel/real3.webp" class="img-fluid w-75 rounded shadow-lg" alt="...">
                      </div>
                      <div class="col-md-5 text-center text-md-start p-3">
                          <h5>Šport</h5>
                          <p>Lukostreľba bola zaradená do olympijských hier už v roku 1900. Dnešní špičkoví strelci triafajú cieľ zo vzdialenosti 70 metrov s presnosťou na veľkosť CD disku.</p>
                      </div>
                  </div>
              </div>

          </div>
          <div class="d-flex justify-content-center mt-3">
              <div class="carousel-indicators position-static">
                  <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
          </div>

      </div>
  </div>

  <!-- overview -->
  <div class="container shadow mb-2 p-3 rounded-2" style="background-color: #80a080;">
      <div class="row g-5">

          <div class="col-6 col-lg-3 d-flex flex-column align-items-center text-center">
              <div class="d-flex justify-content-center align-items-center" style="background-color: white; border-radius: 50%; width: 180px; height: 180px; overflow: hidden;">
                  <img src="assets/images/desc_crossbow.webp" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
              </div>
              <div>
                  <h3>Kuše</h3>
                  <p>Kompaktné a silné – kuše kombinujú silu luku s precíznosťou pušky. Vhodné na lov, šport aj hobby streľbu. Vybrať si môžete z viacerých typov vrátane reflexných, kladkových alebo pištoľových kuší.</p>
              </div>
          </div>


          <div class="col-6 col-lg-3 d-flex flex-column align-items-center text-center">
              <div class="d-flex justify-content-center align-items-center" style="background-color: white; border-radius: 50%; width: 180px; height: 180px; overflow: hidden;">
                  <img src="assets/images/desc_long-bowwebp.webp" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
              </div>
              <div>
                  <h3>Dlhé luky</h3>
                  <p>Tradičné dlhé luky sú jednoduché, ale mimoriadne účinné zbrane s bohatou históriou. Ich elegantná konštrukcia z jedného kusa dreva poskytuje vysokú presnosť a dosah. Ideálne pre milovníkov klasickej lukostreľby.</p>
              </div>
          </div>


          <div class="col-6 col-lg-3 d-flex flex-column align-items-center text-center">
              <div class="d-flex justify-content-center align-items-center" style="background-color: white; border-radius: 50%; width: 180px; height: 180px; overflow: hidden;">
                  <img src="assets/images/desc_normal-bow.avif" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
              </div>
              <div>
                  <h3>Reflexné luky</h3>
                  <p>Reflexné luky sú ľahké, skladné a pružné. Vychádzajú z tradičného dizajnu a sú vhodné najmä pre rekreačných strelcov aj športových nadšencov. Ich zahnuté ramená zabezpečujú silnejší výstrel pri menšej námahe.</p>
              </div>
          </div>


          <div class="col-6 col-lg-3 d-flex flex-column align-items-center text-center">
              <div class="d-flex justify-content-center align-items-center" style="background-color: white; border-radius: 50%; width: 180px; height: 180px; overflow: hidden;">
                  <img src="assets/images/desc_mechanical-bow.webp" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
              </div>
              <div>
                  <h3>Kladkové luky</h3>
                  <p>Moderný typ luku s technológiou kladiek, ktorá umožňuje ľahší náťah a vyššiu silu výstrelu. Kladkové luky sú obľúbené v love aj súťažiach v presnosti. Ich konštrukcia zaručuje stabilitu a výkon.</p>
              </div>
          </div>




      </div>
  </div>


@endsection

@section('footer')
    @include('partials.footer')
@endsection
