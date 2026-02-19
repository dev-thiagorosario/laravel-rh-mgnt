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
    <link rel="icon" href="{{ asset('asset/images/favicon.png')}}" type="image/png">
    <!-- resources -->
    <link rel="stylesheet" href="{{ asset('asset/bootstrap/bootstrap.min')}}.css">
    <link rel="stylesheet" href="{{ asset('asset/fontawesome/css/all')}}.min.css">
    <link rel="stylesheet" href="{{ asset('asset/datatables/datatables.min')}}.css">
    <!-- custom -->
    <link rel="stylesheet" href="{{ asset('asset/css/main.css')}}">
</head>

<body>

<div class="d-flex justify-content-center">
    <p class="text-center display-6 my-5 p-5 border border-primary rounded-4 shadow-sm"><i class="fa-solid fa-gear me-3"></i>RH MANGNT LAYOUT</p>
</div>

<!-- resources -->
<script src="{{ asset('asset/datatables/jquery.min')}}.js"></script>
<script src="{{ asset('asset/bootstrap/bootstrap.bundle')}}.min.js"></script>
<script src="{{ asset('asset/datatables/datatables.min')}}.js"></script>

</body>

</html>
