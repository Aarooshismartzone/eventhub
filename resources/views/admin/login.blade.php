<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts/partials/head')
    <title>Document</title>
</head>

<body style="font-family: 'montserrat', sans-serif;">
    <img src="{{ asset('images/eh_logo.png') }}" class="topleft">
    <div class="row w-100">
        <div class="col-md-6 d-md-block d-none" style="height: 100%">
            <img src="{{asset('images/loginleftimg.jpg')}}" class="left-img">
        </div>
        <div class="col-md-6 loginright">
            <h3 style="font-weight: 800; color: #FF5757">Admin Login</h3>
            @if (session('success'))
                <span class="alert-success">{{ session('success') }}</span>
            @elseif(session('error'))
                <span class="alert-danger">{{ session('error') }}</span>
            @endif
            <div class="mt-4">
                <span style="font-weight: 800; color: #545454">Sign In</span>
            </div>
            <form method="post" action="{{url('/admin/loginchk')}}" class="mt-3" enctype= "multipart/form-data">
                @csrf
                <input type="email" name="email" id="" class="form-control mt-2" placeholder="Email/ Username">
                <input type="password" name="password" id="" class="form-control mt-2" placeholder="Password">
                <div class="text-end mt-3">
                    <a class="lbl" style="color: #07269B; text-align: right">Forgot Password?</a>
                </div>
                <button type="submit" class="btn bluebutton-reg mt-3">Login</button>
            </form>
        </div>
    </div>
    <img src="{{asset('images/eh_logo_name.png')}}" class="mt-2 belowarrow">
</body>

</html>