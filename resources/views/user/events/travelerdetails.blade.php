<form method="post" enctype="multipart/form-data" id="travelerInfo">
    @csrf
    <input type="hidden" value="" name="booking_id" id="booking_id2">
    <h5 class="mt-3" style="font-weight: 800">Traveler Details</h5>
<div class="mt-4 mb-4">
    <div class="card titlehead">Traveler Type</div>
</div>
<div class="row mt-3 w-50">
    <div class="col-5 mt-2 lbl">For Whom</div>
    <div class="col-7">
        <select class="form-control form-select" name="for_whom">
            <option value="self">Myself</option>
            <option value="other">For Other</option>
        </select>
		<span class="error_for_whom qerr"></span>
    </div>
</div>
<button type="button" class="btn editbtn mt-3" onclick="addtrav()">Add Traveler</button>
<div id="addTraveler">
    <div class="mt-4 mb-4">
        <div class="card titlehead" style="max-width: 200px;">
            <nav style="display: flex; justify-content: space-between">
                <div>
                    Traveler Info</div>
                <div style="margin-top:3px;"><i class="fa-solid fa-chevron-up" style="color: white"></i></div>
        </div>
    </div>
    <div class="row mt-3 w-50">
        <div class="col-5 mt-2 lbl">Guest Type</div>
        <div class="col-7">
            <select class="form-control form-select" name="guest_type[]" id="guest_type[]">
                <option value="adult">Adult</option>
                <option value="child">Child</option>
                <option value="teen">Teenager</option>
            </select>
            <div class="minitext">Adults must be 18 and older.</div>
        </div>
    </div>
    <div class="row mt-3 w-50">
        <div class="col-5 lbl">Legal Passport Name</div>
        <div class="col-7"><input type="text" name="guest_name[]" id="guest_name[]" class="form-control"></div>
    </div>
    <div class="row mt-3 w-50">
        <div class="col-5 lbl">Date of Birth (dd-mm-yyyy)</div>
        <div class="col-7" style="position:relative"><input type="date" class="form-control" name="guest_dob[]" id="guest_dob[]">
		<img src="{{asset('images/icons/calender.png')}}" id="datep5" class="cal-icon">
		</div>
    </div>
    
</div>
	<div id="nextcus"></div>
	
    <div class="row mt-3 w-50">
        <div class="col-5 lbl">Would you like to purchase
            trip cancellation wavier? —<br>
            <span style="color: #07269B; font-weight: bold">(${{$event->canc_waiver}})</span>
        </div>
        <div class="col-7">
            {{--<button type="button" class="btn editbtn otl" name="is_canc_waiver" id="is_canc_waiver" value="yes">Yes</button>
            <button type="button" class="btn editbtn-outline" name="is_canc_waiver" value="no">No</button>--}}
            <input type="radio"  name="is_canc_waiver" class="btn-check" value="yes" id="option8">
                        <label id="optnn8" class="btn editbtn otl" for="option8" onclick="changeThree(this)">Yes</label>
            <input type="radio"  name="is_canc_waiver" class="btn-check" value="no" id="option9">
                        <label id="optnn9" class="btn editbtn-outline" for="option9" onclick="changeThree(this)">No</label>

        </div>
    </div>

<!-- <div class="mt-4 mb-4">
    <div class="card titlehead" style="max-width: 200px;">
        <nav style="display: flex; justify-content: space-between">
            <div>
                Traveler Info - 02</div>
            <div><i class="fa-solid fa-chevron-down" style="color: white"></i></div>
    </div>
</div> -->
<div class="mt-4 mb-4">
    <div class="card titlehead" style="max-width: 200px;">
        <nav style="display: flex; justify-content: space-between">
            <div>
                Special Request</div>
            <div style="margin-top:3px;"><i class="fa-solid fa-chevron-up" style="color: white"></i></div>
    </div>
</div>
<div class="w-50">
<div class="lbl mt-3">Please enter comments, room requests, and additional information that we may 
    need to know for your reservation. Please note that we cannot guarantee the 
    fulfillment of these requests, however, the hotels and resorts will do their best to 
    accommodate them.  
</div>  
</div>
<div class="row mt-3 w-50">
    <div class="col-12">
        <textarea class="form-control" name="comments"></textarea>
    </div>
	<span class="error_comments qerr"></span>
</div>
<div class="travelerInfoStatusMsg"></div>
<div class="mt-4 mb-3">
    <button type="button" class="btn bluebutton" style="background-color: #3066BE;" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">Back</button>
    <button type="submit" class="btn bluebutton ms-2" id="travelerInfoBtn">Save & next</button>
</div>
</form>
<script>
$('#travelerInfo').submit(function (stay) {
        $('.qerr').html('');
        $('.travelerInfoStatusMsg').html('');
       
        var formdata=$(this).serialize();
        $.ajax({
                type: "POST",
                url: "{{url('/booking/travelerInfo')}}",
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
                        $('#travelerInfoBtn').hide();
                        $('#booking_id3').val(response.bookingId);                        
                        $('.travelerInfoStatusMsg').html('<div class="card successcard">'+response.msg+'</div>');
                        $("#cimg4").attr("src","{{asset('images/icons/grey-tick-icon-checked.png')}}");
                    }                  
                    
                }

            });
            stay.preventDefault();
    });
</script>
<script>
    var a = document.getElementById("addTraveler").innerHTML;
    var trname = document.getElementById("trname").innerHTML;
    function addtrav() {
        var init = document.getElementById("nextcus").innerHTML;
        document.getElementById("nextcus").innerHTML = init + a;
    }
</script>
<script>
    $(function(){
        $(".datepicker").datepicker({ 
            //minDate: 1, 
            //maxDate: "+1M +10D" 
        });
    });
	
	function dpkr(dtp){
	$(dtp).datepicker({ 
            minDate: 1, 
            maxDate: "+1M +10D" 
        });
	}

    function dateselect(datep){
        $("#" + datep).datepicker("show");
    }
</script>

	<script>
		function changeThree(chg){
		var opt1 = document.getElementById("optnn8");
		var opt2 = document.getElementById("optnn9");
		if(chg.innerHTML == "Yes"){
				opt1.classList.add("editbtn", "otl");
				opt1.classList.remove("editbtn-outline");
				opt2.classList.remove("editbtn", "otl");
				opt2.classList.add("editbtn-outline");
			} else {
				opt2.classList.add("editbtn", "otl");
				opt2.classList.remove("editbtn-outline");
				opt1.classList.remove("editbtn", "otl");
				opt1.classList.add("editbtn-outline");
			}
		}
		</script>