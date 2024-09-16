<h5 class="mt-3" style="font-weight: 800">Event & Room Details</h5>
<div class="mt-4 mb-4">
    <form method="post" enctype="multipart/form-data" id="roomInfo">
    @csrf
        <input type="hidden" value="" name="booking_id" id="booking_id">
        <div class="card titlehead">Event Details</div>
          
        <div class="mt-3 w-50">
            <input type="hidden" name="event_from_date" value="{{$event->event_type=='single'? $event->event_date : $event->event_date_from }}">
            <input type="hidden" name="event_to_date" value="{{$event->event_type=='single'? $event->event_date : $event->event_date_to }}">
            <div class="lbl">This event takes place on {{$event->event_type=='single'? $event->event_date : $event->event_date_from }} — {{$event->event_type=='single'? $event->event_date : $event->event_date_to }},
                would you like to extend your stay?</div>
        </div>
        <div class="mt-2">
            {{--<input type="radio" name="is_ext" class="btn-check" value="yes">
            <label class="btn editbtn otl" >Yes</label>
            <input type="radio" name="is_ext" class="btn-check" value="no" >
            <label class="btn editbtn-outline" >No</label>--}}
            
            <input type="radio" class="btn-check " name="is_ext" id="option1" autocomplete="off" value="yes">
            <label class="btn editbtn otl" id="optnn1" for="option1" onclick="changeOne(this)">Yes</label>

            <input type="radio" class="btn-check" name="is_ext" id="option2" autocomplete="off" value="no">
            <label class="btn editbtn-outline" id="optnn2" for="option2" onclick="changeOne(this)">No</label>

        </div>  
			<!-- <span class="error_is_ext qerr"></span> -->
        <div id="extendDiv">
            <div class="row mt-3 w-50">
                <div class="col-5 mt-2 lbl">When would you like to Leave?</div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-12" style="position: relative">
                            <input type="text" class="form-control bg-white" name="leave_date" id="datepicker4" readonly>
                            <img src="{{asset('images/icons/calender.png')}}" id="datep4" onclick="dateselect('datepicker4')" class="cal-icon">
                        </div>
						<span class="error_leave_date qerr"></span>
                    </div>
                </div>
            </div>
            <div class="row mt-3 w-50">
                <div class="col-5 mt-2 lbl">When would you like to Return?</div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-sm-12" style="position: relative">
                            <input type="text" class="form-control bg-white" name="return_date" id="datepicker5" readonly>
                            <img src="{{asset('images/icons/calender.png')}}" id="datep5" onclick="dateselect('datepicker5')" class="cal-icon">
                        </div>
						<span class="error_return_date qerr"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card titlehead mt-3">Room Details</div>
        <div class="mt-3 w-50">
            <div class="lbl">Are you sharing a room with someone who has already made their 
                reservation?
                </div>
        </div>
        <div class="mt-2">
        {{--<input type="radio" name="is_share_room" class="btn-check" value="yes" onclick="nextfn(this.value)">
            <label class="btn btn-secondary" >Yes</label>
            <input type="radio" name="is_share_room" class="btn-check" value="no" onclick="nextfn(this.value)">
            <label class="btn btn-secondary" >No</label>--}}

            <input type="radio" class="btn-check " name="is_share_room" id="option3" value="yes">
            <label class="btn editbtn otl" onclick="changeTwo(this)" id="optnn3" for="option3">Yes</label>

            <input type="radio" class="btn-check" name="is_share_room" id="option4" value="no">
            <label class="btn editbtn-outline" onclick="changeTwo(this)" id="optnn4" for="option4">No</label>
			<!-- <span class="error_is_share_room qerr"></span> -->
        </div>
        <div id="rmdet">
            <div class="lbl mt-3">Please enter your roommate trip confirmation number:
            </div>
            <div class="row mt-3 w-50">
                <div class="col-11">
                    <input type="text" name="share_booking_code" id="" class="form-control">
                </div>
            </div>
			<span class="error_share_booking_code qerr"></span>
        </div>
        
           
            <div class="row mt-5 w-50">
                <div class="col-9 mt-2 lbl">
                    Select the number of <span style="color: #07269B">Single Occupancy</span> rooms you would like to reserve:
                </div>
                <div class="col-3">
                    <select class="form-control form-select" style="font-weight: bold; color: #07269B;" name="single_occupancy">
                        <option style="font-weight: bold; color: #07269B;" value="0">00</option>
                        <option style="font-weight: bold; color: #07269B;" value="1">01</option>
                        <option style="font-weight: bold; color: #07269B;" value="2">02</option>
                        <option style="font-weight: bold; color: #07269B;" value="3">03</option>
                    </select>
                </div>
				<span class="error_single_occupancy qerr"></span>
            </div>
            <div class="row mt-5 w-50">
                <div class="col-9 mt-2 lbl">
                    Select the number of <span style="color: #07269B">Double Occupancy</span> rooms you would like to reserve:
                </div>
                <div class="col-3">
                    <select class="form-control form-select" style="font-weight: bold; color: #07269B;" name="double_occupancy">
                        <option style="font-weight: bold; color: #07269B;" value="0">00</option>
                        <option style="font-weight: bold; color: #07269B;" value="1">01</option>
                        <option style="font-weight: bold; color: #07269B;" value="2">02</option>
                        <option style="font-weight: bold; color: #07269B;" value="3">03</option>
                    </select>
                </div>
				<span class="error_double_occupancy qerr"></span>
            </div>
            <div class="roomInfoStatusMsg"></div>
            <div class="mt-4 mb-3">
                <button type="button" class="btn bluebutton" style="background-color: #3066BE;" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">Back</button>
                <button type="submit" class="btn bluebutton ms-2" id="roomInfoBtn" >Save & next</button>
            </div>
   </form>
</div>
<script>
$('#roomInfo').submit(function (stay) {
        $('.qerr').html('');
        $('.roomInfoStatusMsg').html('');
       
        var formdata=$(this).serialize();
        $.ajax({
                type: "POST",
                url: "{{url('/booking/roomInfo')}}",
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
                        $('#roomInfoBtn').hide();
                        $('#booking_id1').val(response.bookingId);                        
                        $('.roomInfoStatusMsg').html('<div class="card successcard">'+response.msg+'</div>');
                        $("#cimg2").attr("src","{{asset('images/icons/grey-tick-icon-checked.png')}}");
                    }                  
                    
                }

            });
            stay.preventDefault();
    });
</script>




<script>
    $(function(){
		var dateFormat = "mm/dd/yy",
		//var eventDate = "{{$event->event_date}}",
        from = $("#datepicker4").datepicker({ 
			dateFormat: "yy-mm-dd",
         	minDate: new Date('{{$event->event_date}}')
        })
		.on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
        to = $("#datepicker5").datepicker({ 
            dateFormat: "yy-mm-dd",
         	minDate: new Date('{{$event->event_date}}') 
        })
		.on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
			//console.log(eventDate);
      });
		
		function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
    });

    function dateselect(datep){
        $("#" + datep).datepicker("show");
    }
</script>

<script>
		function changeOne(chg){
		var opt1 = document.getElementById("optnn1");
		var opt2 = document.getElementById("optnn2");
		var extendDiv = document.getElementById("extendDiv");
		if(chg.innerHTML == "Yes"){
				opt1.classList.add("editbtn", "otl");
				opt1.classList.remove("editbtn-outline");
				opt2.classList.remove("editbtn", "otl");
				opt2.classList.add("editbtn-outline");
				extendDiv.style.display = "block";
			} else {
				opt2.classList.add("editbtn", "otl");
				opt2.classList.remove("editbtn-outline");
				opt1.classList.remove("editbtn", "otl");
				opt1.classList.add("editbtn-outline");
				extendDiv.style.display = "none";
			}
		}
		</script>

<script>
		function changeTwo(chg){
		var opt1 = document.getElementById("optnn3");
		var opt2 = document.getElementById("optnn4");
		var rmdet = document.getElementById("rmdet");
		if(chg.innerHTML == "Yes"){
				opt1.classList.add("editbtn", "otl");
				opt1.classList.remove("editbtn-outline");
				opt2.classList.remove("editbtn", "otl");
				opt2.classList.add("editbtn-outline");
				rmdet.style.display = "block";
			} else {
				opt2.classList.add("editbtn", "otl");
				opt2.classList.remove("editbtn-outline");
				opt1.classList.remove("editbtn", "otl");
				opt1.classList.add("editbtn-outline");
				rmdet.style.display = "none";
			}
		}
		</script>