<!doctype html>
<html>

<head>
    <title>
        @section('title')@show
        
    </title>
    <meta lang="ru">
    <meta charset="utf-8">
    <link href="{{ URL::asset('assets/css//w3.css'); }}" rel="stylesheet">
    <script src="{{ URL::asset('assets/js/jquery.min.js'); }}"></script>
</head>

<body>
    <div>
        @yield('content')
    </div>
</body>

</html>
