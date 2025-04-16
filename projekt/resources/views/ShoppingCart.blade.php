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

    <!-- Shopping Cart Section -->
    <div style="background-color: #80a080;" class="container rounded-2 p-4 my-2">
        <h2 class="mb-3">Shopping Cart</h2>

        <!--------------------- item in Cart -------------------->
        <div class="row mb-2 p-2 rounded-2" style="background-color: #b9d2b6;">

            <!-- photo -->
            <div class="col-12 col-md-2 text-center mb-3 mb-md-0">
                <img src="assets/images/bows/lazecky-skaut-padouk-dlouhy-luk-01.webp" class="img-fluid rounded-2 responsive-cart-img" alt="Foto produktu">
            </div>


            <!-- Specs -->
            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <h5>Product Name 1</h5>
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
                    <label for="1" class="mb-0">Amount</label>
                    <input type="number" id="cart_item_amount_picker" class="form-control" style="width:80px;" min="1" value="1">
                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </div>
            </div>

        </div>






        <!-- ORDER NOW a Total Price -->
        <div class="row mt-4 ms-5">
            <div class="container container d-flex align-items-center justify-content-between">

                <div class="flex-grow-1 d-flex justify-content-center align-items-center">
                    <a class="btn btn-success btn-lg" href="{{ route('orderDetails') }}">Order now</a>
                </div>
                <div class="text-md-end">
                    <p class="mt-2 mt-md-0 mb-0 fw-bold">Total price: ------</p>
                </div>
            </div>
        </div>
    </div>




@endsection
@section('footer')
    @include('partials.footer')
@endsection
