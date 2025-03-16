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

<!-- Filter a produkty -->
<div style="background-color: #80a080;" class="container rounded-2 p-3 my-2">

    <div class="d-flex flex-column flex-md-row align-items-start gap-2">

        <!-- Ľavý stĺpec: Filter -->
        <div class="col-12 col-md-3 mb-3 mb-md-0 p-3 bg-light rounded-2">
            <h4>Filter</h4>
            <hr>
            <div class="mb-3">
                <label for="filterManufacturer" class="form-label">Výrobca</label>
                <select id="filterManufacturer" class="form-select">
                    <option>Všetci</option>
                    <option>Lazecký</option>
                    <option>Ragim</option>
                    <option>Ek Archery</option>
                    <option>White Feather</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="filterType" class="form-label">Typ luku</label>
                <select id="filterType" class="form-select">
                    <option>Všetko</option>
                    <option>Dlhý luk</option>
                    <option>Reflexný luk</option>
                    <option>Compound luk</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="filterLength" class="form-label">Dĺžka</label>
                <select id="filterLength" class="form-select">
                    <option>Všetko</option>
                    <option>64"</option>
                    <option>68"</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="filterWeight" class="form-label">Sila (lbs)</label>
                <select id="filterWeight" class="form-select">
                    <option>Všetko</option>
                    <option>30</option>
                    <option>35</option>
                    <option>40</option>
                    <option>45</option>
                    <option>50</option>
                </select>
            </div>
            <button class="btn btn-light w-100">Apply Filter</button>
        </div>

        <!-- Pravý stĺpec: Grid produktov -->
        <div class="col-12 col-md-9">
            <div class="row row-cols-2 row-cols-md-2 row-cols-lg-3 g-3">

                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                        class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 1</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 2</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 3</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 1</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 2</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 3</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 1</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 2</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 3</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 1</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 2</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <a href="{{ route('productPage') }}"><img src="assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp"
                                                                  class="card-img-top" alt="Product Image"></a>
                        <div class="card-body">
                            <a href="{{ route('productPage') }}" class="text-dark text-decoration-none">
                                <h5 class="card-title">Product 3</h5>
                            </a>
                            <p class="card-text">Short description.</p>
                        </div>
                    </div>
                </div>






            </div>
        </div>
    </div>
</div>



<!-- footer -->
<footer class="mt-auto py-4" style="background-color: #80a080;">
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
