<div class="mt-4">
    <span style="font-weight: 800; color: #07269B">OTP Verification</span>
    <div class="lbl mt-2">Enter the OTP sent to <b>{{Session::get('mobile')}}</b> to
        your mobile number.</div>
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
<form action="{{url('/user/setotp')}}" method="post"  class="mt-2">
@csrf
    <div class="row" style="width: 80%">
       <input type="number" name="otp" id="" class="form-control">
	   @if($errors->has('otp'))
	   <span class="alert-danger">{{$errors->first('otp')}}</span>
   @endif
    </div>
    <div class="lbl mt-2">Didn't get the code? <span style="color:#07269B; font-weight: bold">Resend OTP</span></div>
    <button type="submit" class="btn bluebutton-reg mt-3">Verify</button>
</form>