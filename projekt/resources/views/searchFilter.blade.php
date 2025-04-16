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
        <form action="{{ route('searchFilter', ['type' => $selectedType]) }}" method="GET" class="col-12 col-md-3 mb-3 mb-md-0 p-3 bg-light rounded-2">
            <h4>Filter</h4>
            <hr>

            {{-- Price range --}}
            <div class="d-flex align-items-center gap-2 mb-2">
                <label for="price_range" class="form-label fw-bold">Cena</label>
                <input type="number" name="price_min" class="form-control" placeholder="Min" value="{{ request('price_min') }}" min="0">
                <span class="fw-bold">–</span>
                <input type="number" name="price_max" class="form-control" placeholder="Max" value="{{ request('price_max') }}" min="0">
            </div>

            {{-- Sorting --}}
            <div class="mb-3">
                <label for="filter_sort" class="form-label">Zoradenie</label>
                <select name="sort" id="filter_sort" class="form-select">
                    <option value="">Nezadané</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Najlacnejšie</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Najdrahšie</option>
                    <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Najpopulárnejšie</option>
                </select>
            </div>

            {{-- Manufacturer --}}
            <div class="mb-3">
                <label for="filter_manufacturer" class="form-label">Výrobca</label>
                <select name="manufacturer" id="filter_manufacturer" class="form-select">
                    <option value="">Všetci</option>
                    @foreach($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}" {{ request('manufacturer') == $manufacturer->id ? 'selected' : '' }}>
                            {{ $manufacturer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if($selectedType == 1)
                {{-- Bow Draw Weight --}}
                <div class="mb-3">
                    <label for="filter_bow_draw_weight" class="form-label">Napínacia sila</label>
                    <select name="bow_draw_weight" id="filter_bow_draw_weight" class="form-select">
                        <option value="">Všetky</option>
                        @foreach($bow_draw_weights as $weight)
                            <option value="{{ $weight->value }}" {{ request('bow_draw_weight') == $weight->value ? 'selected' : '' }}>
                                {{ $weight->value }} lbs
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if($selectedType == 2)
                {{-- Crossbow Draw Weight --}}
                <div class="mb-3">
                    <label for="filter_crossbow_draw_weight" class="form-label">Napínacia sila</label>
                    <select name="crossbow_draw_weight" id="filter_crossbow_draw_weight" class="form-select">
                        <option value="">Všetky</option>
                        @foreach($crossbow_draw_weights as $weight)
                            <option value="{{ $weight->value }}" {{ request('crossbow_draw_weights') == $weight->value ? 'selected' : '' }}>
                                {{ $weight->value }} lbs
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if($selectedType == 3)
                {{-- Slingshot Rubber Width --}}
                <div class="mb-3">
                    <label for="filter_slingshot_rubber_width" class="form-label">Sirka Gumy</label>
                    <select name="slingshot_rubber_width" id="filter_slingshot_rubber_width" class="form-select">
                        <option value="">Všetky</option>
                        @foreach($slingshot_rubber_width as $width)
                            <option value="{{ $width->value }}" {{ request('slingshot_rubber_width') == $width->value ? 'selected' : '' }}>
                                {{ $width->value }} mm
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if($selectedType == 4)
                {{-- Arrow Diameter --}}
                <div class="mb-3">
                    <label for="filter_arrow_diameter" class="form-label">Priemer šípu</label>
                    <select name="arrow_diameter" id="filter_arrow_diameter" class="form-select">
                        <option value="">Všetky</option>
                        @foreach($arrow_diameter as $diameter)
                            <option value="{{ $diameter->value }}" {{ request('arrow_diameter') == $diameter->value ? 'selected' : '' }}>
                                {{ $diameter->value }} mm
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif


            <button class="btn btn-secondary w-100" type="submit">Apply Filter</button>
        </form>

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
            <div class="justify-content-center mt-3">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

        </div> 
        
    </div> 

</div> 


</main>





@endsection
@section('footer')
    @include('partials.footer')
@endsection
