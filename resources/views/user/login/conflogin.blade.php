<div class="confl">
    Your account is created successfully, please <b>sign in</b> to continue.
</div>
<div class="mt-4">
    <span style="font-weight: 800; color: #07269B">Sign In</span>
</div>
<form method="post" action="{{url('/user/loginchk')}}" class="mt-3">
    @csrf
    <input type="email" name="email" id="" class="form-control mt-2" placeholder="Email/ Username">
    <input type="password" name="password" id="" class="form-control mt-2" placeholder="Password">
    <div class="text-end mt-3">
        <a class="lbl" style="color: #07269B; text-align: right">Forgot Password?</a>
    </div>
    <button type="submit" class="btn bluebutton-reg mt-3">Login</button>
</form>