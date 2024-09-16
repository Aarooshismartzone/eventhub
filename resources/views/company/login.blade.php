<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts/partials/head')
    <title>Document</title>
</head>

<body style="font-family: 'montserrat', sans-serif;">
    <div class="row w-100">
        <div class="col-md-6 d-md-block d-none" style="height: 100%">
            <img src="{{asset('images/loginleftimg.png')}}" class="left-img">
            <h1 class="left-title">Welcome to<br>
                Leisure Group Tech</h1>
        </div>
        <div class="col-md-6 loginright">
            <h3 style="font-weight: 800;">Leisure Group Tech</h3>
            @if($type == "registration")
                @include('company/login/regform')
            @endif
            @if($type == "setpass")
                @include('company/login/setpass')
            @endif
            @if($type == "getotp")
                @include('company/login/getotp')
            @endif
            @if($type == "setotp")
                @include('company/login/setotp')
            @endif
            @if($type == "conflogin")
                @include('company/login/conflogin')
            @endif
            @if($type == "normallogin")
                @include('company/login/normallogin')
            @endif
        </div>
    </div>
    <img src="{{asset('images/icons/arrow-mobile.png')}}" class="mt-2 belowarrow">
</body>

</html>