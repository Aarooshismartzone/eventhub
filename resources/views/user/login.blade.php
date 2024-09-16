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
            @if($type == "login")
                @include('user/login/regform')
            @endif
            @if($type == "getotp")
                @include('user/login/otpverification1')
            @endif
            @if($type == "setotp")
                @include('user/login/otpverification2')
            @endif
            @if($type == "conflogin")
                @include('user/login/conflogin')
            @endif
            @if($type == "normallogin")
                @include('user/login/normallogin')
            @endif
        </div>
    </div>
    <img src="{{asset('images/icons/arrow-mobile.png')}}" class="mt-2 belowarrow">
</body>

</html>