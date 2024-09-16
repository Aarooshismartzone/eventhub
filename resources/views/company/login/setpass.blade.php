<div class="mt-4">
    <span style="font-weight: 800; color: #07269B">Set Password</span>
	@if (session('success'))
        <span class="alert-danger">
          {{ session('success') }}
        </span>
        @elseif(session('error'))
       <span class="alert-danger">
          {{ session('error') }}
        </span>
        @endif
</div>
 
<form method="post" class="mt-3" action="{{url('company/setpass')}}">
@csrf
    <input type="password" name="password" id="" class="form-control mt-2" placeholder="Setup Password">
	<span class="alert-danger">{{$errors->first('password')}}</span>
    <input type="password" name="confirm_password" id="" class="form-control mt-2" placeholder="Confirm Password">
    <div class="minitext mt-3">Your password must have at least 8 characters and contain at
        least two of the following: uppercase letters, lowercase letters,
        numbers, and symbols.</div>
    <button type="submit" class="btn bluebutton-reg mt-3">Register</button>
</form>