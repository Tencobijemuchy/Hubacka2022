@extends('layouts.app')


@section('content')

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
                    <a href="{{ route('login') }}" class="text-dark"><i class="bi bi-person-lock"></i></a>
                </h1>
            </div>
        </div>
    </nav>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="container">
                <span class="fs-5">
                <i class="bi bi-exclamation-circle-fill px-2"></i>
                No products added to cart! Please add products to cart, then proceed to order.
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="container p-2 rounded mb-2" style="background-color: #80a080;">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8 order-2 order-lg-1 pe-0">
                <form method="POST" action="{{ route('order.submit') }}" class="was-validated" >
                    @csrf

                    <!-- Delivery -->
                    <div class="mb-2 p-3 bg-light rounded shadow">
                        <h4><i class="bi bi-truck me-3"></i>Spôsob dopravy</h4>
                        <div class="border rounded p-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="delivery" id="delivery_option_kurier" value="Kuriér" {{ old('delivery') == 'Kuriér' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="delivery_option_kurier">Kuriér</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="delivery" id="delivery_option_packeta" value="Packeta / DPD" {{ old('delivery') == 'Packeta / DPD' ? 'checked' : '' }}>
                                <label class="form-check-label" for="delivery_option_packeta">Packeta / DPD</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="delivery" id="delivery_slovenska_posta" value="Slovenská pošta" {{ old('delivery') == 'Slovenská pošta' ? 'checked' : '' }}>
                                <label class="form-check-label" for="delivery_slovenska_posta">Slovenská pošta</label>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Options -->
                    <div class="mb-2 p-3 bg-light rounded shadow-sm">
                        <h4><i class="bi bi-currency-euro me-3"></i>Výber platby</h4>
                        <div class="border rounded p-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment_cash" value="Hotovosť" {{ old('payment') == 'Hotovosť' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="payment_cash">Hotovosťou (pri prevzatí)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment_card" value="Karta" {{ old('payment') == 'Karta' ? 'checked' : '' }}>
                                <label class="form-check-label" for="payment_card">Platobnou kartou</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment_bank_transfer" value="Bankový prevod" {{ old('payment') == 'Bankový prevod' ? 'checked' : '' }}>
                                <label class="form-check-label" for="payment_bank_transfer">Bankovým prevodom</label>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="mb-3 p-3 bg-light rounded shadow-sm">
                        <h4><i class="bi bi-house-door me-3"></i>Dodacie údaje</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">Meno</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Priezvisko</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" value="{{ old('last_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">Mesto</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Adresa</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="psc" class="form-label">PSČ</label>
                                <input type="text" class="form-control" id="psc" name="postal_code" value="{{ old('postal_code') }}" pattern="^\d{3,10}$" required>
                                <div class="invalid-feedback">
                                    Zadajte platné PSČ (iba číslice).
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Telefónne číslo</label>
                                <input type="text" class="form-control" id="phone" name="phone_number" value="{{ old('phone_number') }}" pattern="^\+?\d{5,15}$" required>
                                <div class="invalid-feedback">
                                    Zadajte platné telefónne číslo (iba číslice, voliteľne "+" na začiatku).
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" pattern="^[^@\s]+@[^@\s]+\.[^@\s]{2,}$" required>
                                <div class="invalid-feedback">
                                    Zadajte platný e-mail (napr. meno@domena.sk).
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-secondary" href="{{ route('shoppingCart') }}">Zrušiť</a>
                        <button type="submit" class="btn btn-success">Potvrdiť objednávku</button>
                    </div>
                </form>

            </div>


            <!-- Right Column: Shopping Cart -->
            <div class="col-lg-4 order-1 order-lg-2 mb-3">
                <div class="bg-light rounded p-3 shadow-sm">
                    <div class="d-flex justify-content-end">
                        <h4>Shopping cart<i class="bi bi-cart ms-2"></i></h4>
                    </div>
                    @php $cartTotal = 0; @endphp
                    @foreach ($cartItems as $item)
                        @php
                            $name = is_object($item) ? $item->name : $item['name'];
                            $quantity = is_object($item) ? $item->quantity : $item['quantity'];
                            $img = is_object($item) ? $item->img1 : $item['img1'];
                            $price = is_array($item) ? $item['price'] : $item->price;

                            $totalPrice = $price * $quantity;
                            $cartTotal += $totalPrice;
                        @endphp
                        <div class="d-flex align-items-center border-bottom py-2">
                            <div class="col-3" style="overflow: hidden;">
                                <img src="{{ asset($img) }}" class="img-fluid" style="width: auto; height: 90px; object-fit:cover;" alt="Product image">
                            </div>

                            <div class="col-6 ms-2 flex-grow-1">{{ $name }}</div>
                            <div class="col-3 text-end pe-5">{{ number_format($totalPrice, 2) }}€</div>
                        </div>
                    @endforeach
                    <div class="container d-flex justify-content-center mt-2">
                        <span class="fs-4 text-secondary"> {{ number_format($cartTotal, 2) }}€ </span>
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
