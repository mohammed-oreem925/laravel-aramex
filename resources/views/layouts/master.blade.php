<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title', 'Default Title')</title>

    <meta name="description" content="@yield('description', '')">
    <meta name="keywords" content="@yield('keywords', '')">
    <meta name="author" content="@yield('author', '')">

    <link rel="stylesheet" href="\css\app.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="/js/app.js"></script>

    @yield('page-styles')
    <style>
        .active {
            background-color: #007bff;
            color: white;
        }
    </style>
    <script>
        var language = '{{ app()->getLocale() }}';
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/aramex">{{ __('master.aramex') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/aramex/shipments/create">{{ __('master.shipment.create') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/aramex/shipments">{{ __('master.shipment.plural') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/aramex/pickups">{{ __('master.pickup.plural') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/aramex/rate">{{ __('master.rate.get') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/aramex/label">{{ __('master.printLabel') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/aramex/reserveRange">{{ __('master.reserveRange') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"id="langDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ __('master.language') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="langDropdown">
                                <li><a href="{{ url('lang/en') }}"
                                        class="dropdown-item lang-option {{ app()->getLocale() == 'en' ? 'active' : '' }}">{{ __('master.english') }}</a>
                                </li>
                                <li><a href="{{ url('lang/ar') }}"
                                        class="dropdown-item lang-option {{ app()->getLocale() == 'ar' ? 'active' : '' }}">{{ __('master.arabic') }}</a>
                                </li>
                            </ul>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/users">{{ __('master.user.plural') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">{{ __('master.logout') }}</a>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/register">{{ __('master.register') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">{{ __('master.login') }}</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container p-5">
        @yield('content')
    </div>

    {{-- Vite JS --}}
    @yield('page-scripts')
    <script>
        $(document).ready(function() {
            $('.lang-option').each(function() {
                if ($(this).text().trim().toLowerCase() === language) {
                    $(this).addClass('active');
                }
            });

            $('.lang-option').click(function() {
                $('.lang-option').removeClass('active');
                $(this).addClass('active');
                language = $(this).text().trim().toLowerCase();
                setCookie('language', language, 7);
            });
        });
    </script>
</body>

</html>
