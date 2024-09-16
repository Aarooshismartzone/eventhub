<div class="mt-4">
    <span style="font-weight: 800; color: #07269B">OTP Verification</span>
    <div class="lbl mt-2">We will send you an one time Password
        to your mobile number.</div>
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
@php
$codes=DB::table('countries')->distinct()->pluck('phonecode');
//dd($codes);
//$countries=DB::table('countries')->whereIn('phonecode',$codes)->get();
@endphp
<form action="{{url('/company/getotp')}}" method="post" class="mt-2">
@csrf
    <label for="mob" class="lbl">Enter Mobile Number</label>
    <div class="row">
        <div class="col-3 p-1">
            <input type="hidden" id="ctry" name="country" value="AF">
            <input type="hidden" id="ctrycd" name="countrycode" value="93">
            
            <div class="dropdown">
            
                <button class="btn dropdown-toggle selcont" type="button" id="dropdownMenuButton2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('images/flags/flag-of-Afghanistan.jpg')}}" width="20" height="15" id="cfi">
                </button>
                <ul class="dropdown-menu ddm1" style="height: 300px; overflow-y:scroll" aria-labelledby="dropdownMenuButton2" role="menu">
                    @foreach($codes as $code)
					@php
						$country=DB::table('countries')->where('phonecode',$code)->first();
					@endphp
                    <li onclick="country(['{{$country->shortname}}', '{{$country->phonecode}}', `{{asset('images/flags/flag-of-'.$country->name.'.jpg')}}`])"><span class="dropdown-item"><img src="https://flagsapi.com/{{$country->shortname}}/shiny/64.png" width="20px" height="15px" id="{{$country->shortname}}"> <b>{{$country->name}}</b> <span style="color: grey">+{{$country->phonecode}}</span></span></li>
                                @endforeach
                    {{--<li onclick="country(['Canada', '1'])"><span class="dropdown-item"><img
                                src="{{asset('images/icons/flags/canflag.png')}}"
                                width="20" height="15" id="Canada"> Canada</span></li>
                    <li onclick="country(['UK', '44'])"><span class="dropdown-item"><img
                                src="{{asset('images/icons/flags/ukflag.png')}}"
                                width="20" height="15" id="UK"> UK</span></li>--}}
                </ul>
            </div>
           
        </div>
        <div class="col-9 p-1">
            <input type="number" name="phone" id="" class="form-control">
        </div>
    </div>
    <button type="submit" class="btn bluebutton-reg mt-3">Get OTP</button>
    <script>
        function country(ctry){
            document.getElementById("ctry").value = String(ctry[0]);
            document.getElementById("ctrycd").value = String(ctry[1]);
            //var cf = document.getElementById(ctry[0]).src;
			console.log(String(ctry[2]));
            document.getElementById("cfi").src = String(ctry[2]);
        }
    </script>
</form>
