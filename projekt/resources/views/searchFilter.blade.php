@extends('layouts.app')

@section('content')
    <main class="flex-fill">
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
                <a type="button" class="btn {{ $selectedType == 1 ? 'btn-secondary' : 'btn-light' }} w-100"
                   href="{{ route('searchFilter', ['type' => 1]) }}">
                    Luky
                </a>
            </div>
            <div class="col-6 col-md">

                <a type="button" class="btn {{ $selectedType == 2 ? 'btn-secondary' : 'btn-light' }} w-100"
                   href="{{ route('searchFilter', 2) }}">
                    Kuše
                </a>
            </div>
            <div class="col-6 col-md">

                <a type="button" class="btn {{ $selectedType == 3 ? 'btn-secondary' : 'btn-light' }} w-100"
                   href="{{ route('searchFilter', 3) }}">
                    Praky
                </a>
            </div>
            <div class="col-6 col-md">
                <a type="button" class="btn {{ $selectedType == 4 ? 'btn-secondary' : 'btn-light' }} w-100"
                   href="{{ route('searchFilter', 4) }}">
                    Šípy
                </a>
            </div>
            <div class="col-6 col-md">
                <a type="button" class="btn {{ $selectedType == 5 ? 'btn-secondary' : 'btn-light' }} w-100"
                   href="{{ route('searchFilter', 5) }}">
                    Príslušenstvo
                </a>
            </div>
        </div>

    </div>



    <!-- filter and products -->
    <div style="background-color: #80a080;" class="container rounded-2 p-3 my-2">

        <div class="d-flex flex-column flex-md-row align-items-start gap-2">

            <!-- filter -->
            <div class="col-12 col-md-3 mb-3 mb-md-0 p-3 bg-light rounded-2">
                <h4>Filter</h4>
                <hr>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <label for="price_range" class="form-label fw-bold">Cena</label>
                    <input type="number" 
                            name="price_min" 
                            class="form-control" 
                            placeholder="Min" 
                            value="{{ request('price_min') }}" 
                            min="0">
                    <span class="fw-bold">–</span>
                    <input type="number" 
                            name="price_max" 
                            class="form-control" 
                            placeholder="Max" 
                            value="{{ request('price_max') }}" 
                            min="0">
                </div>
                <div class="mb-3">
                    <label for="filter_sort" class="form-label">Zoradenie</label>
                    <select id="filter_sort" class="form-select">
                        <option>Nezadané</option>
                        <option>Najlacnejšie</option>
                        <option>Najdrahšie</option>
                        <option>Najpopulárnejšie</option>  
                    </select>
                </div>
                <div class="mb-3">
                    <label for="filter_manufacturer" class="form-label">Výrobca</label>
                    <select id="filter_manufacturer" class="form-select">
                        <option>Všetci</option>
                        <option>Lazecký</option>
                        <option>Ragim</option>
                        <option>Ek Archery</option>
                        <option>White Feather</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="filter_type" class="form-label">Typ luku</label>
                    <select id="filter_type" class="form-select">
                        <option>Všetko</option>
                        <option>Dlhý luk</option>  
                        <option>Reflexný luk</option>
                        <option>Compound luk</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="filter_length" class="form-label">Dĺžka</label>
                    <select id="filter_length" class="form-select">
                        <option>Všetko</option>
                        <option>64"</option>
                        <option>68"</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="filter_weight" class="form-label">Sila (lbs)</label>
                    <select id="filter_weight" class="form-select">
                        <option>Všetko</option>
                        <option>30</option>
                        <option>35</option>
                        <option>40</option>
                        <option>45</option>
                        <option>50</option>
                    </select>
                </div>
                <button class="btn btn-secondary w-100">Apply Filter</button>
            </div>

            <!-- product grid -->
            <div class="col-12 col-md-9">
                <div id="product-grid" class="row row-cols-2 row-cols-md-2 row-cols-lg-3 g-3">
                    @foreach($products as $product)
                        <div class="col">
                            <div class="card h-100">
                                <a href="{{ route('products.show', $product->id) }}">
                                    <img src="{{ asset($product->img1) }}"
                                         class="card-img-top"
                                         style="height: 300px; object-fit: cover;"
                                         alt="{{ $product->name }}">
                                </a>
                                <div class="card-body">
                                    <a href="{{ route('products.show', $product->id) }}" class="text-dark text-decoration-none">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                    </a>
                                    <p class="card-text">{{ $product->price }}€</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination links -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $products->links() }}
                </div>
            </div>


        </div>
    </div>

</main>





@endsection
@section('footer')
    @include('partials.footer')
@endsection
