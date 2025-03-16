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

    <!-- Shopping Cart Section -->
    <div style="background-color: #80a080;" class="container rounded-2 p-3 my-2">
        <h2 class="mb-3">Shopping Cart</h2>

        <!--------------------- item in Cart -------------------->
        @for ($i = 1; $i <= 5; $i++)
            <div class="row mb-3 p-2 rounded-2" style="background-color: #b9d2b6;">
                <!-- photo -->
                <div class="col-12 col-md-2 text-center mb-3 mb-md-0">
                    <img src="{{ asset('assets/images/lazecky-skaut-padouk-dlouhy-luk/lazecky-skaut-padouk-dlouhy-luk-01.webp') }}"
                         class="img-fluid rounded-2 responsive-cart-img" alt="Foto produktu">
                </div>

                <!-- Specs -->
                <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <h5>Product Name {{ $i }}</h5>
                    <p class="mb-1">Specifications and chosen customizations of selected product.</p>
                    <p class="mb-1">Orientation: --- | Length: ---" | Draw Weight: --- lbs</p>
                </div>

                <!-- prices -->
                <div class="col-12 col-md-4 d-flex flex-column align-items-end">
                    <!-- Cenové informácie hore -->
                    <p class="mb-1">Price without DPH: 100.00</p>
                    <p class="mb-1">Price with DPH: 120.00</p>

                    <!-- buttons -->
                    <div class="mt-auto d-flex align-items-center gap-2">
                        <label for="{{ $i }}" class="mb-0">Amount</label>
                        <input type="number" id="{{ $i }}" class="form-control" style="width:80px;" min="1" value="1">
                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            </div>
        @endfor

        <!-- ORDER NOW a Total Price -->
        <div class="row mt-4 ms-5">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="flex-grow-1 d-flex justify-content-center align-items-center">
                    <button class="btn btn-success btn-lg">ORDER NOW</button>
                </div>
                <div class="text-md-end">
                    <p class="mt-2 mt-md-0 mb-0 fw-bold">Total price: ------</p>
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
                        <strong>+421 905 194 679</strong>
                    </div>
                </div>
                <!-- Email -->
                <div class="col-12 col-lg-3 col-md-6 d-flex align-items-center">
                    <i class="bi bi-envelope-fill fs-4 me-2"></i>
                    <div>
                        <a class="text-decoration-none text-dark fw-bold" aria-disabled="true">
                            <strong>customer_helpline@LukEshop.com</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
