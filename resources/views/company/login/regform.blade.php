<div class="mt-4">
    <span style="font-weight: 800; color: #07269B">Sign Up</span>
    <span style="color: #3066BE; font-size: 26px; margin-left: 10px; margin-right: 10px">|</span>
    <b>Sign In</b>
</div>
<form method="post" action="{{url('/company/registration')}}" class="mt-3" enctype= "multipart/form-data">
	@csrf
    <input type="text" name="fname"  class="form-control mt-2" placeholder="First Name">
	<span class="alert-danger">{{$errors->first('fname')}}</span>
    <input type="text" name="lname" id="" class="form-control mt-2" placeholder="Last Name">
    <input type="email" name="email"  class="form-control mt-2" placeholder="Company Email">
    <input type="text" name="company_legal_name" id="" class="form-control mt-2" placeholder="Company Legal Name">
    <button type="submit" class="btn bluebutton-reg mt-3">Next</button>
</form>

