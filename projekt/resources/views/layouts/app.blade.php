<!doctype html>
<html lang="en">
<head>
    <title>@yield('title', 'LukEshop')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100" style="background-color: #B7C9B2;">
<main class="flex-fill">
    @yield('content')
</main>

{{-- Footer sa zobrazí iba ak je definovaná sekcia 'footer' --}}
@hasSection('footer')
    @yield('footer')
@endif

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/js/adminPageScripts.js') }}"></script>
<script src="{{ asset('assets/js/shoppingCartScripts.js') }}"></script>
</body>
</html>
