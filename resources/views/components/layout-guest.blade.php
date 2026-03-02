@props([
    'pageTitle' => null,
    'showNavigation' => true,
])

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ env('APP_NAME') }} @isset($pageTitle)
            - {{ $pageTitle }}
        @endisset
    </title>

    <!-- favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
    <!-- resources -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <!-- custom -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"> 
</head>

<body>
    @auth
        @if($showNavigation)
            <x-user-bar-component></x-user-bar-component>

            <div class="app-shell">
                <x-side-bar-component></x-side-bar-component>

                <main class="app-shell__content">
                    {{ $slot }}
                </main>
            </div>
        @else
            {{ $slot }}
        @endif
    @else
        {{ $slot }}
    @endauth
    <!-- resources -->
    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
