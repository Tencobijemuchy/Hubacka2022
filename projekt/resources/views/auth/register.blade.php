@extends('layouts.app')

@section('title', 'Register - LukEshop')

@section('content')
    <body class="d-flex justify-content-center align-items-center vh-100" style="background-color: #B7C9B2;">
        <div class="container">
            <div class="row" style="height: 700px;">
                <!-- Sekcia pre login (zobrazuje sa na väčších obrazovkách) -->
                <div class="col-md-4 p-5 bg-secondary-subtle d-flex flex-column justify-content-center align-items-center text-dark text-center rounded-2 shadow d-none d-md-flex">
                    <div>
                        <p class="mb-1 fs-4">Already have an account?</p>
                        <p class="mb-4 fs-5">Log in!</p>
                        <a href="{{ route('login') }}" class="btn btn-dark btn-lg px-4">Log in</a>
                    </div>
                </div>

                <!-- Registrácia -->
                <div class="col-md-8 p-5 d-flex flex-column justify-content-center align-items-center bg-secondary text_white rounded-2 shadow position-relative">
                    <!-- Close Button -->
                    <div class="position-absolute absolute top-0 start-0 p-2">
                        <a type="button" class="btn btn-close btn-lg" aria-label="Close" href="{{ route('index') }}"></a>
                    </div>

                    <div class="mb-5">
                        <div class="rounded-circle bg-light d-flex justify-content-center align-items-center" style="width: 90px; height: 90px;">
                            <i class="bi bi-person-add fs-1"></i>
                        </div>
                    </div>

                    <form action="{{ route('register') }}" method="POST" class="w-75">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label text-white">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-white">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Enter username" value="{{ old('username') }}" required>
                            </div>
                            @error('username')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-white">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                            </div>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-white">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="d-grid col-12 col-lg-6 col-md-9 col-sm-9 mt-4">
                                <button type="submit" class="btn btn-outline-light btn-lg">
                                    Sign up <i class="bi bi-plus-lg ms-1"></i>
                                </button>
                            </div>
                            <p class="d-block d-md-none text-center text-white mt-5">
                                Already have an account? <a href="{{ route('login') }}" class="text-white"><strong>Log in</strong></a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

@endsection
