@extends('layouts.app')

@section('content')

<!-- navbar with logo and account button, logo -->
<nav class="navbar navbar-expand-sm navbar-light mb-2 bg-dark">
    <div class="container d-flex align-items-center justify-content-between flex-nowrap">
        <div class="d-flex align-items-center flex-nowrap">
            <a href="{{ route('index') }}" class="me-3">
                <img class="img-fluid" style="width:60px;" src="assets/images/logo.svg" alt="logo">
            </a>
            <h1 class="mb-0 fs-4"><a href="{{ route('index') }}" class="text-white text-decoration-none">LukEshop</a></h1>
        </div>
        <div></div>
        <h1 class="pe-5 text-white">Admin</h1>
        <div>
        </div>
        <div class="dropdown">
            @if(auth()->check())
                <button class="btn btn-secondary me-3 px-4 dropdown-toggle no-caret" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ auth()->user()->username }}
                </button>

                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" style="background-color: #dc3545; color: white;">Logout</button>
                        </form>
                    </li>
                </ul>
            @else
                <button class="btn btn-secondary me-3 px-4" disabled>guest</button>
            @endif
        </div>
    </div>
</nav>


<div class="container bg-dark rounded-2 gap-3 p-2">

    <!-- admin item -->
    <div class="bg-white rounded-3 p-2 d-flex justify-content-center mb-2">
        <div class="row w-100">
            <!-- Image Column -->
            <div class="col-3 col-md-2">
                <img src="assets/images/default_shop_img.webp" class="img-fluid">
            </div>

            <!-- Description + Buttons Column -->
            <div class="col-9 col-md-10 d-flex flex-column">
                <!-- Product Information -->
                <div>
                    <h5>Product Name</h5>
                    <p>Some examplary description that is temporary </p>
                </div>

                <!-- Buttons aligned at the bottom -->
                <div class="d-flex justify-content-end mt-auto gap-2">
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-file-text"></i> Inspect
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-gear"></i> Modify
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- admin item -->
    <div class="bg-white rounded-3 p-2 d-flex justify-content-center mb-2">
        <div class="row w-100">
            <!-- Image Column -->
            <div class="col-3 col-md-2">
                <img src="assets/images/default_shop_img.webp" class="img-fluid">
            </div>

            <!-- Description + Buttons Column -->
            <div class="col-9 col-md-10 d-flex flex-column">
                <!-- Product Information -->
                <div>
                    <h5>Product Name</h5>
                    <p>Some examplary description that is temporary </p>
                </div>

                <!-- Buttons aligned at the bottom -->
                <div class="d-flex justify-content-end mt-auto gap-2">
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-file-text"></i> Inspect
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-gear"></i> Modify
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- admin item -->
    <div class="bg-white rounded-3 p-2 d-flex justify-content-center mb-2">
        <div class="row w-100">
            <!-- Image Column -->
            <div class="col-3 col-md-2">
                <img src="assets/images/default_shop_img.webp" class="img-fluid">
            </div>

            <!-- Description + Buttons Column -->
            <div class="col-9 col-md-10 d-flex flex-column">
                <!-- Product Information -->
                <div>
                    <h5>Product Name</h5>
                    <p>Some examplary description that is temporary </p>
                </div>

                <!-- Buttons aligned at the bottom -->
                <div class="d-flex justify-content-end mt-auto gap-2">
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-file-text"></i> Inspect
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-gear"></i> Modify
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- admin item -->
    <div class="bg-white rounded-3 p-2 d-flex justify-content-center mb-2">
        <div class="row w-100">
            <!-- Image Column -->
            <div class="col-3 col-md-2">
                <img src="assets/images/default_shop_img.webp" class="img-fluid">
            </div>

            <!-- Description + Buttons Column -->
            <div class="col-9 col-md-10 d-flex flex-column">
                <!-- Product Information -->
                <div>
                    <h5>Product Name</h5>
                    <p>Some examplary description that is temporary </p>
                </div>

                <!-- Buttons aligned at the bottom -->
                <div class="d-flex justify-content-end mt-auto gap-2">
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-file-text"></i> Inspect
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-gear"></i> Modify
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- admin item -->
    <div class="bg-white rounded-3 p-2 d-flex justify-content-center mb-2">
        <div class="row w-100">
            <!-- Image Column -->
            <div class="col-3 col-md-2">
                <img src="assets/images/default_shop_img.webp" class="img-fluid">
            </div>

            <!-- Description + Buttons Column -->
            <div class="col-9 col-md-10 d-flex flex-column">
                <!-- Product Information -->
                <div>
                    <h5>Product Name</h5>
                    <p>Some examplary description that is temporary </p>
                </div>

                <!-- Buttons aligned at the bottom -->
                <div class="d-flex justify-content-end mt-auto gap-2">
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-file-text"></i> Inspect
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-gear"></i> Modify
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- admin item -->
    <div class="bg-white rounded-3 p-2 d-flex justify-content-center mb-2">
        <div class="row w-100">
            <!-- Image Column -->
            <div class="col-3 col-md-2">
                <img src="assets/images/default_shop_img.webp" class="img-fluid">
            </div>

            <!-- Description + Buttons Column -->
            <div class="col-9 col-md-10 d-flex flex-column">
                <!-- Product Information -->
                <div>
                    <h5>Product Name</h5>
                    <p>Some examplary description that is temporary </p>
                </div>

                <!-- Buttons aligned at the bottom -->
                <div class="d-flex justify-content-end mt-auto gap-2">
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-file-text"></i> Inspect
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-gear"></i> Modify
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- admin item -->
    <div class="bg-white rounded-3 p-2 d-flex justify-content-center mb-2">
        <div class="row w-100">
            <!-- Image Column -->
            <div class="col-3 col-md-2">
                <img src="assets/images/default_shop_img.webp" class="img-fluid">
            </div>

            <!-- Description + Buttons Column -->
            <div class="col-9 col-md-10 d-flex flex-column">
                <!-- Product Information -->
                <div>
                    <h5>Product Name</h5>
                    <p>Some examplary description that is temporary </p>
                </div>

                <!-- Buttons aligned at the bottom -->
                <div class="d-flex justify-content-end mt-auto gap-2">
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-file-text"></i> Inspect
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-gear"></i> Modify
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- admin item -->
    <div class="bg-white rounded-3 p-2 d-flex justify-content-center mb-2">
        <div class="row w-100">
            <!-- Image Column -->
            <div class="col-3 col-md-2">
                <img src="assets/images/default_shop_img.webp" class="img-fluid">
            </div>

            <!-- Description + Buttons Column -->
            <div class="col-9 col-md-10 d-flex flex-column">
                <!-- Product Information -->
                <div>
                    <h5>Product Name</h5>
                    <p>Some examplary description that is temporary </p>
                </div>

                <!-- Buttons aligned at the bottom -->
                <div class="d-flex justify-content-end mt-auto gap-2">
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-file-text"></i> Inspect
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-gear"></i> Modify
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- admin item -->
    <div class="bg-white rounded-3 p-2 d-flex justify-content-center mb-2">
        <div class="row w-100">
            <!-- Image Column -->
            <div class="col-3 col-md-2">
                <img src="assets/images/default_shop_img.webp" class="img-fluid">
            </div>

            <!-- Description + Buttons Column -->
            <div class="col-9 col-md-10 d-flex flex-column">
                <!-- Product Information -->
                <div>
                    <h5>Product Name</h5>
                    <p>Some examplary description that is temporary </p>
                </div>

                <!-- Buttons aligned at the bottom -->
                <div class="d-flex justify-content-end mt-auto gap-2">
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-file-text"></i> Inspect
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-gear"></i> Modify
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>



</div>



@endsection
