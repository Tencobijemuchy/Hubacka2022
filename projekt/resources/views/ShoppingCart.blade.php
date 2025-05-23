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

    <!-- Shopping Cart Section -->
    <div style="background-color: #80a080;" class="container rounded-2 p-4 my-2">
        <h2 class="mb-3">Shopping Cart</h2>

        @foreach ($items as $item)
            @php
                // if the user is looged in we must take the items from his cart, other we must take them from the session 
                $isObject = is_object($item);
                $id = $isObject ? $item->product_id ?? $item->id : $item['id'];
                $name = $isObject ? $item->name : $item['name'];
                $price = $isObject ? $item->price : $item['price'];
                $description = $isObject ? $item->description : $item['description'];
                $quantity = $isObject ? $item->quantity : $item['quantity'];
                $img = $isObject ? $item->img1 : $item['img1'];
                $rawCustom = is_object($item) ? $item->customizations : ($item['customizations'] ?? null);

                $customizations = is_string($rawCustom) && str_starts_with(trim($rawCustom), '{')
                    ? json_decode($rawCustom, true)
                    : $rawCustom;

                if (is_array($customizations)) {
                    $customizations = array_filter($customizations, fn($value) => !is_null($value) && $value !== '');
                }
            @endphp

            <div class="row mb-2 p-2 rounded-2" style="background-color: #b9d2b6;">
                <!-- photo -->
                <div class="col-12 col-md-2 text-center mb-3 mb-md-0" style="overflow: hidden;">
                    <img src="{{ asset($img) }}" class="img-fluid bg-light rounded-2 shadow" style="height: 200px; width: auto; object-fit: cover;" alt="Product image">
                </div>


                <!-- Specs -->
                <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <p class="fs-5 mb-2"><strong>{{ $name }}</strong></p>
                    <p class="fs-6 mb-2">{{ $description }}</p>

                    @if (is_array($customizations) && count($customizations))
                        <p class="mb-1 text-muted">
                            @foreach ($customizations as $key => $value)
                                <span><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</span>@if (!$loop->last) <span class="mx-1">|</span> @endif
                            @endforeach
                        </p>
                    @elseif (!empty($customizations))
                        <p class="mb-1 text-muted">{{ $customizations }}</p>
                    @endif
                </div>

                <!-- prices -->
                <div class="col-12 col-md-4 d-flex flex-column align-items-end text-end">
                    <p class="mb-1 fs-5">Price: {{ number_format($price, 2) }}</p>

                    <div class="mt-auto d-flex align-items-center gap-2">
                        <label for="item_{{ $id }}" class="mb-0">Amount</label>
                        <input type="number" id="item_{{ $id }}" name="amounts[{{ $id }}]" oninput="if (this.value < 1) this.value = 1;" class="form-control" style="width:80px;" min="1" value="{{ $quantity }}">

                        <form action="{{ route('shopping-cart.destroy', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="customizations" value="{{ base64_encode(json_encode($customizations ?? [])) }}">
                            <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach







        <!-- ORDER NOW a Total Price -->
        <div class="row mt-4 ms-5">
            <div class="container container d-flex align-items-center justify-content-between">

                <div class="flex-grow-1 d-flex justify-content-center align-items-center">
                    <a class="btn btn-success btn-lg" href="{{ route('order.form') }}">Order now</a>
                </div>
                <div class="text-md-end">
                    <p class="mt-2 mt-md-0 mb-0 fw-bold" id="cart-total">Total price: {{ $totalPrice }}</p>
                </div>
            </div>
        </div>
    </div>




@endsection
@section('footer')
    @include('partials.footer')
@endsection
