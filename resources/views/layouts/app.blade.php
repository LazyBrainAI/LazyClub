
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">


    <link rel="stylesheet" href= {{ URL::asset('css/bootstrap.min.css') }}>

    @section('include_css')
    @show

    <link rel="stylesheet" href= {{ URL::asset('css/app.css') }}>
    <title>Lazy Club | @yield('title')</title>
</head>
<body id="@yield('id')">

@section('page_top_picture')
@show

@section('main')
@show


<script src={{ URL::asset('js/jquery-3.3.1.min.js') }}></script>
<script src={{ URL::asset('js/bootstrap.min.js') }}></script>
<script src={{ URL::asset('js/main.js') }}></script>


</body>
</html>