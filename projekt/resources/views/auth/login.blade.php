@extends('layouts.app')

@section('content')
    @if (session('login_failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="container">
                <span class="fs-5">
                <i class="bi bi-exclamation-circle-fill"></i>
                Login failed. Please check your credentials.
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-center vh-100" style="background-color: #B7C9B2;">
        <div class="container">
            <div class="row" style="height: 700px;">
                <!-- Login sekcia -->
                <div class="col-md-8 p-5 d-flex flex-column justify-content-center align-items-center bg-secondary-subtle rounded-2 shadow position-relative">
                    <!-- Close Button -->
                    <div class="position-absolute top-0 start-0 p-2">
                        <a class="btn btn-close btn-lg" aria-label="Close" href="{{ route('index') }}"></a>
                    </div>

                    <div class="mb-5">
                        <div class="rounded-circle bg-light d-flex justify-content-center align-items-center" style="width: 90px; height: 90px;">
                            <i class="bi bi-person fs-1"></i>
                        </div>
                    </div>

                    <form action="{{ route('login') }}" method="POST" class="w-75">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Username or Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" name="login" class="form-control @error('login') is-invalid @enderror" placeholder="Enter username or email" value="{{ old('login') }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password" class="form-control  @error('login') is-invalid @enderror" placeholder="Enter password" required>
                                @error('login')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="d-grid col-12 col-lg-6 col-md-9 col-sm-9 mt-4">
                                <button type="submit" class="btn btn-dark btn-lg">
                                    Log in <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                            <p class="d-block d-md-none text-center text-dark mt-5">
                                Don't have an account? <a href="{{ route('register') }}" class="text-dark"><strong>Create one!</strong></a>
                            </p>
                        </div>
                    </form>
                </div>


                <div class="col-md-4 p-5 bg-secondary d-flex flex-column justify-content-center align-items-center text-dark text-center rounded-2 shadow d-none d-md-flex">
                    <div>
                        <p class="mb-1 fs-4">Don't have an account?</p>
                        <p class="mb-4 fs-5">Create one!</p>
                        <a href="{{ route('register') }}" class="btn btn-dark btn-lg px-4">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
