@extends('layouts.app')

@section('content')
    <!-- navbar -->
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
            <div></div>
            <div class="d-flex align-items-center flex-nowrap">
                <div class="dropdown">
                    @if(auth()->check())
                        <button class="btn btn-secondary me-3 px-4 dropdown-toggle no-caret" type="button"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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

    <div style="background-color: #80a080;" class="container rounded-2 p-3 my-2">
        <div class="row align-items-stretch">

            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <div class="h-100 p-3 rounded-2" style="background-color: #80a080;">
                    <div id="carouselProduct" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- img1 -->
                            <div class="carousel-item active" data-bs-interval="5000">
                                <div class="d-flex bg-light rounded-2 justify-content-center align-items-center">
                                    <img src="{{ asset($product->img1) }}"
                                         class="img-fluid d-block mx-auto rounded-2"
                                         style="height: 500px; object-fit: cover;"
                                         alt="{{ $product->name }}">
                                </div>
                            </div>
                            <!-- img2, ak existuje -->
                            @if($product->img2)
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="d-flex bg-light rounded-2 justify-content-center align-items-center">
                                        <img src="{{ asset($product->img2) }}"
                                             class="img-fluid d-block mx-auto rounded-2"
                                             style="height: 500px; object-fit: cover;"
                                             alt="{{ $product->name }}">
                                    </div>
                                </div>
                            @endif
                            <!-- img3, ak existuje -->
                            @if($product->img3)
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="d-flex bg-light rounded-2 justify-content-center align-items-center">
                                        <img src="{{ asset($product->img3) }}"
                                             class="img-fluid d-block mx-auto rounded-2"
                                             style="height: 500px; object-fit: cover;"
                                             alt="{{ $product->name }}">
                                    </div>
                                </div>
                            @endif
                            <!-- img4, ak existuje -->
                            @if($product->img4)
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="d-flex bg-light rounded-2 justify-content-center align-items-center">
                                        <img src="{{ asset($product->img4) }}"
                                             class="img-fluid d-block mx-auto rounded-2"
                                             style="height: 500px; object-fit: cover;"
                                             alt="{{ $product->name }}">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <div class="carousel-indicators position-static">
                                <button type="button" data-bs-target="#carouselProduct" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                @php
                                    $slideIndex = 1;
                                @endphp
                                @if($product->img2)
                                    <button type="button" data-bs-target="#carouselProduct" data-bs-slide-to="{{ $slideIndex++ }}" aria-label="Slide 2"></button>
                                @endif
                                @if($product->img3)
                                    <button type="button" data-bs-target="#carouselProduct" data-bs-slide-to="{{ $slideIndex++ }}" aria-label="Slide 3"></button>
                                @endif
                                @if($product->img4)
                                    <button type="button" data-bs-target="#carouselProduct" data-bs-slide-to="{{ $slideIndex++ }}" aria-label="Slide 4"></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-12 col-md-6">
                <div class="h-100 p-3 rounded-2" style="background-color: #80a080;">
                    <div class="mb-3 bg-light rounded-2 shadow p-3">
                        <h4 class="mb-1">{{ $product->name }}</h4>

                        <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                        <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                        <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                        <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                        <span class="text-warning"><i class="bi bi-star-fill"></i></span>

                    </div>

                    <div class="mb-3 bg-light rounded-2 shadow p-3">
                        <p class="mb-0">
                            <strong>Manufacturer:</strong>
                            {{ $product->manufacturer ? $product->manufacturer->name : 'Unknown' }}
                        </p>
                        <p class="mb-0">
                            <strong>Description:</strong>
                            {{ $product->description }}
                        </p>

                    </div>

                    <div class="mb-3 bg-light rounded-2 shadow p-3">
                        <h5>Customization</h5>


                        @if($product->product_type_id == 1)
                            <div class="mb-2">
                                <label for="orientation" class="form-label">Orientation</label>
                                <select id="orientation" class="form-select">
                                    @foreach($orientations as $orient)
                                        <option value="{{ $orient }}">{{ ucfirst($orient) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="bow_length" class="form-label">Bow Length</label>
                                <select id="bow_length" class="form-select">
                                    @foreach($bowLengths as $length)
                                        <option value="{{ $length }}">{{ $length }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif






                        @if($product->product_type_id == 1 || $product->product_type_id == 2)
                            <div class="mb-2">
                                <label for="bow_strength" class="form-label">Draw Weight</label>
                                <select id="bow_strength" class="form-select">
                                    @foreach($drawWeights as $weight)
                                        <option value="{{ $weight }}">{{ $weight }} lbs</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>

                    <!-- Add to cart -->
                    <div class="d-flex align-items-center gap-2 mb-2 justify-content-between">
                        <div class="col-4">
                            <button class="btn btn-warning">Add to cart</button>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-warning active">{{ $product->price }}€</button>
                        </div>
                        <div class="col-3 d-flex flex-column align-items-end">
                            <label for="amount" class="form-label mb-1">Amount</label>
                            <input type="number" id="order_amount" class="form-control" style="max-width: 70px; min-width: 50px;" min="1" value="1">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>





@endsection
@section('footer')
    @include('partials.footer')
@endsection
