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



    <div class="container p-2 rounded mb-2" style="background-color: #80a080;">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8 order-2 order-lg-1 pe-0">
                <!-- Delivery -->
                <div class="mb-2 p-3 bg-light rounded shadow">
                    <h4><i class="bi bi-truck me-3"></i>Spôsob dopravy</h4>
                    <div class="border rounded p-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delivery" id="delivery_option_kurier">
                            <label class="form-check-label" for="delivery1">Kuriér</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delivery" id="delivery_option_packeta">
                            <label class="form-check-label" for="delivery2">Packeta / DPD</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delivery" id="delivery_slovenska_posta">
                            <label class="form-check-label" for="delivery3">Slovenská pošta</label>
                        </div>
                    </div>
                </div>

                <!-- Payment Options -->
                <div class="mb-2 p-3 bg-light rounded shadow-sm">
                    <h4><i class="bi bi-currency-euro me-3"></i>Výber platby</h4>
                    <div class="border rounded p-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="payment_cash">
                            <label class="form-check-label" for="payment1">Hotovosťou (pri prevzatí)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="payment_card">
                            <label class="form-check-label" for="payment2">Platobnou kartou</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="payment_bank_transfer">
                            <label class="form-check-label" for="payment3">Bankovým prevodom</label>
                        </div>
                    </div>

                </div>

                <!-- Payment Details -->
                <div class="mb-3 p-3 bg-light rounded shadow-sm">
                    <h4><i class="bi bi-house-door me-3"></i>Dodacie údaje</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">Meno</label>
                            <input type="text" class="form-control" id="firstName">
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Priezvisko</label>
                            <input type="text" class="form-control" id="lastName">
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">Mesto</label>
                            <input type="text" class="form-control" id="city">
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Adresa</label>
                            <input type="text" class="form-control" id="address">
                        </div>
                        <div class="col-md-6">
                            <label for="psc" class="form-label">PSČ</label>
                            <input type="text" class="form-control" id="psc">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telefónne číslo</label>
                            <input type="text" class="form-control" id="phone">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <a class="btn btn-secondary" href="ShoppingCart.html">Cancel</a>
                    <button class="btn btn-success" id="alertButton">Confirm Purchase</button>
                </div>
            </div>


            <!-- Right Column: Shopping Cart -->
            <div class="col-lg-4 order-1 order-lg-2 mb-3">
                <div class="bg-light rounded p-3 shadow-sm">
                    <div class="d-flex justify-content-end">
                        <h4>Shopping cart<i class="bi bi-cart ms-2"></i></h4>
                    </div>

                    <div class="d-flex align-items-center border-bottom py-2">
                        <img src="assets/images/Bows/1742942552332.jpg" class="img-fluid" style="width: 50px; height: 70px;"></img>
                        <div class="ms-2 flex-grow-1">Cobra</div>
                        <div>214,72€</div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <img src="assets/images/Bows/products_red_deer.png" class="img-fluid" style="width: 50px; height: 70px;"></img>
                        <div class="ms-2 flex-grow-1">Red Deer</div>
                        <div>213,23€</div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <img src="assets/images/Bows/Skylark__55835.png" class="img-fluid" style="width: 50px; height: 70px;"></img>
                        <div class="ms-2 flex-grow-1">Skylark</div>
                        <div>134,65€</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>














    <script>
        document.getElementById('alertButton').addEventListener('click', function() {
            const alertInfo = {
                farba: 'info', // can be 'success', 'danger', 'warning', etc.
                ikona: 'check-circle', // icon class (Bootstrap Icons)
                text: 'Your order has been placed successfully!'
            };

            // Save the alert info to localStorage
            localStorage.setItem('alertInfo', JSON.stringify(alertInfo));

            // Redirect to index.html
            window.location.href = 'index.html';
        });
    </script>




@endsection

@section('footer')
    @include('partials.footer')
@endsection
