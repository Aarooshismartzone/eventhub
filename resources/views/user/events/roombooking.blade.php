<h5 class="mt-3" style="font-weight: 800">Room Booking</h5>
<div class="mt-4 mb-4">
    <div class="card titlehead">Room Booking</div>
</div>
<div class="mt-4">
    <img src="{{url('images/'.$image)}}" class="hotel-image">
</div>
<h5 class="mt-3" style="color: #07269B; font-weight: bold;">{{$event->event_name}}</h5>
<div class="lbl mt-2"><img src="{{asset('images/icons/location.png')}}" style="width: 18px;"> {{$event->event_map_address}}</div>
    <form method="post" enctype="multipart/form-data" id="packageInfo">
        @csrf
        <input type="hidden" value="" name="booking_id" id="booking_id1">
        <div class="mt-3">
            @foreach($packages as $p=>$pack)
            <div id="hpg{{$p}}">
                <div class="card titlehead"
                    style="background-color: #FF6600; font-weight: bold; margin-bottom: -20px; margin-left: 0px; z-index: 2">
                    Package
                    {{$p+1}}
                </div>
                <div class="card width-adjust amcard" id="am{{$p}}">
                    <div class="row">
                        <div class="col-2">
                            <h5 class="mt-3" style="color: #07269B; font-weight: bold;">{{$pack->package_name}}</h5>
                        </div>
                        <div class="col-5 mt-3">
                            <div class="lbl">Price per adult: ${{$pack->price_per_adult}}</div>
                        </div>
                        <div class="col-5 mt-3">
                        {{-- <button type="button" class="btn editbtn border-0" id="pkb{{$p}}" name="package_id" value="{{$pack->id}}" onclick="activatepkg(this)">
                                Select
                            </button>
                            --}}
                            {{--<input type="radio" id="pkb{{$p}}" name="package_id" class="btn-check" value="{{$pack->id}}" onclick="activatepkg(this)" >
                            <label class="btn btn-secondary" >Selected</label>--}}
                                
                            <input type="radio" class="btn-check" name="package_id" id="option{{$p+5}}" value="{{$pack->id}}">
                            <label class="btn editbtn border-0 bcgg" for="option{{$p+5}}" onclick="btnColorChg(this)">Select</label>
                        </div>
						
                    </div>
                    <div class="row mt-3" id="btr{{$p}}">
                        <div class="col-4">
                            <div class="lbl">Price per child/infant: ${{$pack->price_per_child}}</div>
                        </div>
                        <div class="col-4">
                            <div class="lbl">Price per teenager: ${{$pack->price_per_teenager}}</div>
                        </div>
                        <div class="col-4">
                          <!--   <div class="lbl">Last Date of Deposit - {{$event->deposit_last_date}}</div> --> 
							<!-- was asked to remove until further clarification from client-->
                        </div>
                    </div>
                </div>
                <span class="error_package_id qerr"></span>
            </div>
            @endforeach    
        </div>
        <div class="packageInfoStatusMsg"></div>
        <div class="mt-4 mb-3">
            <button type="button" class="btn bluebutton" style="background-color: #3066BE;" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">Back</button>
            <button type="submit" class="btn bluebutton ms-2" id="packageInfoBtn">Save & next</button>
        </div>
    </form>

<script>
    // function activatepkg(butn) {
    //     for (i = 1; i <= {{count($packages)}}; i++) {
    //         var btr = document.getElementById("btr" + i);
    //         var btz = document.getElementById("pkb" + i);
    //         var am = document.getElementById("am" + i);
    //         btr.style.display = "none";
    //         btz.classList.add("addbtn");
    //         btz.classList.remove("greenbtn");
    //         am.classList.add("amcard2");
    //         am.classList.remove("amcard");
    //         btz.innerHTML = "Select";
    //     }
    //     var idx = butn.id.substring(butn.id.length - 1);
    //     var disbtr = document.getElementById("btr" + idx);
    //     var disam = document.getElementById("am" + idx);
    //     disbtr.style.display = "flex";
    //     butn.classList.add("greenbtn");
    //     butn.classList.remove("addbtn");
    //     disam.classList.add("amcard");
    //     disam.classList.remove("amcard2");
    //     butn.innerHTML = "Selected";
    // }
</script>
<script>
$('#packageInfo').submit(function (stay) {
        $('.qerr').html('');
        $('.packageInfoStatusMsg').html('');
       
        var formdata=$(this).serialize();
        $.ajax({
                type: "POST",
                url: "{{url('/booking/packageInfo')}}",
                data:formdata,
                cache: true,
                success: function(response){
                    if( response.status == false ) {
                                     
                        $.each(response.errors, function (errors_key, errors_val) {
                            console.log(errors_key,errors_val);
                            $('.error_'+errors_key).html(errors_val[0]).css("color","red","display","show");
                            $( errors_key ).text(errors_val[0]);
                        });
                        //$('.eventDetailsStatusMsg').html('<span style="color:red;">'+response.msg+'</p>');
                    }
                    if( response.status == true ) {
                        $('#packageInfoBtn').hide();
                        $('#booking_id2').val(response.bookingId);                        
                        $('.packageInfoStatusMsg').html('<div class="card successcard">'+response.msg+'</div>');
                        $("#cimg3").attr("src","{{asset('images/icons/grey-tick-icon-checked.png')}}");
                    }                  
                    
                }

            });
            stay.preventDefault();
    });
</script>
<script>
		function btnColorChg(sbb){
		$('.bcgg').addClass('editbtn');
		$('.bcgg').removeClass('greenbtn');
		$('.bcgg').html('Select');
		$(sbb).addClass('greenbtn');
		$(sbb).removeClass('editbtn');
		$(sbb).html('Selected');
	}
</script>