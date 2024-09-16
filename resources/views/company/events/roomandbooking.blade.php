<!-- room and booking -->
<p class="roomAndBookingStatusMsg"></p>
<div class="mt-3" style="font-weight: 800">Room and Booking</div>
<div class="mt-4">
<form method="post" enctype="multipart/form-data" id="roomAndBooking">
        @csrf
        <input type="hidden" name="event_id" id="event_id" value="">
        <div class="card titlehead">Venue & Booking</div>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Hotel/Venue Name</div>
            <div class="col-sm-9 col-7"><input type="text" name="hotel_name" id="hotel_name" class="form-control"></div>
            <span class="error_hotel_name qerr"></span>
        </div>
        
	
	<div class="row width-adjust">
            <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">No. of Single Occupancy rooms</div>
            <div class="col-md-3 col-sm-9 col-7 mt-3"><input type="number" class="form-control" id="sor" name="single_occupancy" onclick='addRoom();' onkeyup='addRoom();' value="0"></div>
            <span class="error_single_occupancy qerr"></span>
        </div>
        <div class="row width-adjust">
            <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">No. of Double Occupancy rooms</div>
            <div class="col-md-3 col-sm-9 col-7 mt-3"><input type="number" class="form-control" id="dor" name="double_occupancy" onclick='addRoom();' onkeyup='addRoom();' value="0"></div>
            <span class="error_double_occupancy qerr"></span>
        </div>
        <div class="row width-adjust">
            <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Total No. of Rooms</div>
            <div class="col-md-3 col-sm-9 col-7 mt-3"><input type="text" id="tor" class="form-control textblue bg-white" name="total_rooms" readonly></div>
            <span class="error_total_rooms qerr"></span>
        </div>
        <div class="row width-adjust">
            <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Deposit Amount</div>
            <div class="col-md-3 col-sm-9 col-7 mt-3">
                <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input type="text"
                        class="form-control" name="deposit_amount"></div>
                        <span class="error_deposit_amount qerr"></span>
            </div>
        </div>
        <div class="row width-adjust">
            <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Last Date of Deposit</div>
            <div class="col-md-3 col-sm-9 col-7 mt-3">
				<div style="position: relative">
                <input type="text" class="form-control bg-white" name="deposit_last_date" id="datepicker3" class="datepicker" readonly>
                <img src="{{asset('images/icons/calender.png')}}" id="seedate1" onclick="dateselect('datepicker3')" style="right: 10px" class="cal-icon">
				</div>
                
            </div>
            <span class="error_deposit_last_date qerr"></span>
        </div>
        <div class="row width-adjust">
            <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Cancellation Waiver</div>
            <div class="col-md-3 col-sm-9 col-7 mt-3">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">$</span>
                    <input type="text" class="form-control" name="canc_waiver">
                </div>
                        <span class="error_canc_waiver qerr"></span>
            </div>
        </div>

        

        <div class="row width-adjust">
            <nav style="display: flex; justify-content: space-between" class="mt-4">
                <div class="card titlehead">Packages</div>
                <button type="button" class="card addbtn" onclick="addpackage()">Add Package</button>
            </nav>
        </div>
        <div  id="addpackage">
            <div class="row width-adjust mt-3">
                <div class="col-sm-3 col-5 mt-2 lbl">Package Name</div>
                <div class="col-sm-9 col-7"><input type="text" class="form-control" name="package_name[]" required></div>
                <span class="error_package_name[] qerr"></span>
            </div>
            <div class="row width-adjust">
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Adult</div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input
                            type="text" class="form-control" name="price_per_adult[]" required></div>
                </div>
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Adult<br><span class="minitext">Extended</span></div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input
                            type="text" class="form-control" name="price_per_adult_extended[]" required></div>
                </div>
            </div>
            <div class="row width-adjust">
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Max no. of Adults Allowed</div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <input type="text" class="form-control" name="max_allowed_adult[]" required>
                </div>
            </div>
            <hr class="mt-5 width-adjust">
            <div class="row width-adjust">
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Teenager</div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">$</span>
                        <input type="text" class="form-control" name="price_per_teenager[]" required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Teenager<br><span class="minitext">Extended</span></div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input
                            type="text" class="form-control" name="price_per_teenanger_extended[]" required></div>
                </div>
            </div>
            <div class="row width-adjust">
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Max no. of Teenagers Allowed</div>
                <div class="col-md-3 col-sm-9 col-7 mt-3"><input type="text" class="form-control" name="max_allowed_teenager[]" required></div>
            </div>
            <hr class="mt-5 width-adjust">
            <div class="row width-adjust">
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Child/Infant</div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input
                            type="text" class="form-control" name="price_per_child[]" required></div>
                </div>
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Child/Infant<br><span class="minitext">Extended</span></div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input
                            type="text" class="form-control" name="price_per_child_extended[]" required></div>
                </div>
            </div>
            <div class="row width-adjust">
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Max no. of Children/ Infants Allowed</div>
                <div class="col-md-3 col-sm-9 col-7 mt-3"><input type="text" class="form-control" name="max_allowed_child[]" required></div>
            </div>
            <hr>
        </div>
        
        <div id="displaypackageform"></div>
        <div class="roomAndBookingStatusMsg"></div>
        <div class="mt-4 mb-3">
            <button type="submit" class="btn bluebutton" id="roomAndBookingBtn">Save & next</button>
        </div>
    </form>
</div>
<script>
    $(function(){
       canDate = $("#datepicker3").datepicker({ 
            minDate: 0, 
            //maxDate: "+1M +10D" 
        });
    });

    function dateselect(datep){
    $("#" + datep).datepicker("show");
}
</script>
<script>
    var a = document.getElementById("addpackage").innerHTML;
    function addpackage(){
        var init = document.getElementById("displaypackageform").innerHTML;
            document.getElementById("displaypackageform").innerHTML = init + a;
    }
</script>
                    <!-- room and booking end -->

<script>
    $('#roomAndBooking').submit(function (stay) {
        $('.qerr').html('');
        $('.roomAndBookingStatusMsg').html('');
       
        var formdata=$(this).serialize();
        $.ajax({
                type: "POST",
                url: "{{url('/add-room-and-booking')}}",
                data:formdata,
                cache: true,
                success: function(response){
                    if( response.status == false ) {
                                     
                        $.each(response.errors, function (errors_key, errors_val) {
                            console.log(errors_key,errors_val);
                            $('.error_'+errors_key).html(errors_val[0]).css("color","red","display","show");
                            $( errors_key ).text(errors_val[0]);
                        });
                        // $('.roomAndBookingStatusMsg').html('<span style="color:red;">'+response.msg+'</p>');
                    }
                    if( response.status == true ) {
                        $('#roomAndBookingBtn').hide();
                        $('#event_id1').val(response.eventId);
                        $('.roomAndBookingStatusMsg').html('<div class="card successcard">'+response.msg+'</div>');
                        $("#cimg2").attr("src","{{asset('images/icons/grey-tick-icon-checked.png')}}");
                    }
                }

            });
            stay.preventDefault();
    });
</script>
<script>
	function addRoom(){
		var sor = parseInt(document.getElementById("sor").value);
		var dor = parseInt(document.getElementById("dor").value);
		document.getElementById("tor").value =  (sor + dor);
	}
</script>
                
