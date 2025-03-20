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
                <!-- temporary admin access until php login is functional -->

                <div class="dropdown">
                    @if(auth()->check())
                        <button class="btn btn-secondary me-3 px-4 dropdown-toggle no-caret" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->username }}
                        </button>

<<<<<<< HEAD:ProcuctPage.html
<!-- quick select -->
<div style="background-color: #80a080;" class="container rounded-2 p-3 mt-2 shadow">
  <div class="row g-3">
    <div class="col-6 col-md">
      <a type="button" class="btn btn-light w-100" href="searchFilter.html">Luky</a>
    </div>
    <div class="col-6 col-md">
      <a type="button" class="btn btn-light w-100" href="searchFilter.html">Kuše</a>
    </div>
    <div class="col-6 col-md">
      <a type="button" class="btn btn-light w-100" href="searchFilter.html">Praky</a>
    </div>
    <div class="col-6 col-md">
      <a type="button" class="btn btn-light w-100" href="searchFilter.html">Šípy</a>
    </div>
    <div class="col-6 col-md">
      <a type="button" class="btn btn-light w-100" href="searchFilter.html">Príslušenstvo</a>
    </div>
  </div>
</div>
=======
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
                    <a href="{{ route('login') }}" class="text-dark"><i class="bi bi-person-lock"></i></a>
                </h1>
            </div>
        </div>
    </nav>

    <!-- search box and shopping cart icon -->
    <div style="background-color: #80a080;" class="container d-flex align-items-center justify-content-between rounded-2 shadow">
        <div class="flex-grow-1 d-flex justify-content-center ps-5">
            <div class="py-2" style="width: 60%;">
                <input type="text" class="form-control col-8 col-sm-12" placeholder="Search box" />
            </div>
        </div>
        <div>
            <h2 class="mb-0 px-1">
                <a href="{{ route('shoppingCart') }}" class="text-dark">
                    <i class="bi bi-bag-fill"></i>
                </a>

                </a>
            </h2>
        </div>
    </div>

    <!-- quick select -->
    <div style="background-color: #80a080;" class="container rounded-2 p-3 mt-2 shadow">
        <div class="row g-3">
            <div class="col-6 col-md">
                <a type="button" class="btn btn-light w-100" href="{{ route('searchFilter') }}">Luky</a>
            </div>
            <div class="col-6 col-md">
                <a type="button" class="btn btn-light w-100" href="{{ route('searchFilter') }}">Kuše</a>
            </div>
            <div class="col-6 col-md">
                <a type="button" class="btn btn-light w-100" href="{{ route('searchFilter') }}">Praky</a>
            </div>
            <div class="col-6 col-md">
                <a type="button" class="btn btn-light w-100" href="{{ route('searchFilter') }}">Príslušenstvo</a>
            </div>
            <div class="col-6 col-md">
                <a type="button" class="btn btn-light w-100" href="{{ route('searchFilter') }}">Ostatné</a>
            </div>
        </div>
    </div>
>>>>>>> b6a10bec4707ce6b4c2d7a8d70118187da02156f:projekt/resources/views/productPage.blade.php

<div style="background-color: #80a080;" class="container rounded-2 p-3 my-2">
    <div class="row align-items-stretch">
        <div class="col-12 col-md-6 mb-3 mb-md-0">
            <!-- Carousel -->
            <div class="h-100 p-3 rounded-2" style="background-color: #80a080;">
                <div id="carouselExampleAutoplaying" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active" data-bs-interval="5000">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                     class="img-fluid d-block mx-auto rounded" alt="...">
                            </div>
                        </div>

                        <div class="carousel-item" data-bs-interval="5000">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-02.webp"
                                     class="img-fluid d-block mx-auto rounded" alt="...">
                            </div>
                        </div>

                        <div class="carousel-item" data-bs-interval="5000">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-03.webp"
                                     class="img-fluid d-block mx-auto rounded" alt="...">
                            </div>
                        </div>

                        <div class="carousel-item" data-bs-interval="5000">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-04.webp"
                                     class="img-fluid d-block mx-auto rounded" alt="...">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <div class="carousel-indicators position-static">
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 col-md-6">
            <div class="h-100 p-3 rounded-2" style="background-color: #80a080;">

                <div class="mb-3 bg-light rounded-2 shadow p-3">
                    <h4 class="mb-1">SKAUT Padouk Prémium</h4>
                    <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                    <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                    <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                    <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                    <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                </div>

                <div class="mb-3 bg-light rounded-2 shadow p-3">
                    <p class="mb-0"><strong>Manufacturer:</strong> Lazecký</p>
                    <p class="mb-0"><strong>Description:</strong> Dlhý luk pre začiatočníkov aj profíkov</p>
                </div>

  
                <div class="mb-3 bg-light rounded-2 shadow p-3">
                    <h5>Customization</h5>
                    <div class="mb-2">
                        <label for="orientation" class="form-label">Orientation</label>
                        <select id="orientation" class="form-select">
                            <option value="ľavý">Left</option>
                            <option value="pravý">Right</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="bowLength" class="form-label">Bow Length</label>
                        <select id="bowLength" class="form-select">
                            <option value="64">64"</option>
                            <option value="68">68"</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="bowStrength" class="form-label">Draw Weight</label>
                        <select id="bowStrength" class="form-select">
                            <option value="30">30 lbs</option>
                            <option value="35">35 lbs</option>
                            <option value="40">40 lbs</option>
                            <option value="45">45 lbs</option>
                            <option value="50">50 lbs</option>
                        </select>
                    </div>
                </div>

                <!-- Add to cart -->
                <div class="d-flex align-items-center gap-2 mb-2 justify-content-between">
                  <div class="col-4">
                      <button class="btn btn-warning">Add to cart</button>
                  </div>

<<<<<<< HEAD:ProcuctPage.html
                  <div class="col-3">
                      <a href="#" class="btn btn-warning active" role="button">149,99€</a>
                      
                  </div>
=======
                    <div class="col-6">
                        <button class="btn btn-primary">Add to cart</button>
                    </div>

>>>>>>> b6a10bec4707ce6b4c2d7a8d70118187da02156f:projekt/resources/views/productPage.blade.php

                  <div class="col-3 d-flex flex-column align-items-end">
                      <label for="amount" class="form-label mb-1">Amount</label>
                      <input type="number" id="amount" class="form-control" style="max-width: 70px;min-width: 50px;" min="1" value="1">
                  </div>
                </div>

<<<<<<< HEAD:ProcuctPage.html
                
=======
>>>>>>> b6a10bec4707ce6b4c2d7a8d70118187da02156f:projekt/resources/views/productPage.blade.php

            </div>
        </div>

    </div>
</div>
<!-- footer -->
<footer class="mt-auto py-4 mt-2" style="background-color: #80a080;">
    <div class="container">
        <div class="row text-center text-md-start justify-content-between align-items-center">

            <!-- Address -->
            <div class="col-12 col-lg-3 col-md-6 d-flex align-items-center mb-3 mb-md-0">
                <i class="bi bi-geo-alt-fill fs-4 me-2"></i>
                <div>
                    <div>Ilkovičova 6276/2</div>
                    <strong>842 16 Bratislava 4</strong>
                </div>
            </div>

            <!-- Phone -->
            <div class="col-12 col-lg-2 col-md-6 d-flex align-items-center mb-3 mb-md-0">
                <i class="bi bi-telephone-fill fs-4 me-2"></i>
                <div>
                    <strong>+421 905 194 679 </strong>
                </div>
            </div>

            <!-- Email -->
            <div class="col-12 col-lg-3 col-md-6 d-flex align-items-center">
                <i class="bi bi-envelope-fill fs-4 me-2"></i>
                <div>
                    <a class="text-decoration-none text-dark fw-bold" aria-disabled="true"><strong>customer_helpline@LukEshop.com</strong></a>
                </div>
            </div>

        </div>
    </div>
</footer>

@endsection
