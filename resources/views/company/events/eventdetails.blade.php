<!-- event details -->

<div class="mt-3" style="font-weight: 800">Event Details</div>

    
<div class="mt-4">   
    <form method="post" enctype="multipart/form-data" id="eventDetails">
        @csrf
        <div class="card titlehead">Create Event</div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Event Name</div>
            <div class="col-sm-9 col-7"><input type="text" name="event_name" class="form-control" ></div>
            <span class="error_event_name qerr"></span>
        </div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Event Type</div>
            <div class="col-sm-9 col-7">
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control form-select" name="event_type" onclick="flipday(this)" onchange="flipday(this)">
                            <option value="single">Single Day</option>
                            <option value="multiple">Multi Day</option>
                        </select>
                    </div>
                    <span class="error_event_type qerr"></span>
                </div>
            </div>
        </div>
        <div id="singleday">
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">Event Date</div>
                <div class="col-sm-9 col-7">
                    <div class="row">
                        <div class="col-sm-6" style="position: relative">
                            <input type="text" class="form-control bg-white" name="event_date" id="datepicker" class="datepicker" readonly>
                            <img src="{{asset('images/icons/calender.png')}}" id="seedate1" onclick="dateselect('datepicker')" class="cal-icon">
                        </div>
                    </div>
                    <span class="error_event_date qerr"></span>
                </div>

            </div>
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">Event Time</div>
                <div class="col-sm-9 col-7">
                    <div class="row">
                        <div class="col-sm-6">
                            {{--<select class="form-control form-select" name="event_time_from">
                                @include('company/time')
                                
                            </select>--}}
                            
                            <input type="time" name="event_time_from" id="" class="form-control">
							<span class="error_event_time_from qerr"></span>
                        </div>
                            
                        <div class="col-sm-6 up1">
                            {{--<select class="form-control form-select" name="event_time_to">
                                @include('company/time')
                                
                            </select>--}}
                            <input type="time" name="event_time_to" id="" class="form-control">
                            <span class="error_event_time_to qerr"></span>
                        </div>
                    </div>
                    <div class="lbl">The time slot selection is only for single day events</div>
                </div>
            </div>
        </div>
        <div id="multiday" style="display: none;">
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">Check In</div>
                <div class="col-sm-9 col-7">
                    <div class="row">
                        <div class="col-sm-6" style="position: relative">
                            <input type="text" class="form-control bg-white" id="datepicker1" class="datepicker" name="event_date_from">
                            <img src="{{asset('images/icons/calender.png')}}" id="seedate1" onclick="dateselect('datepicker1')" class="cal-icon">
                        </div>
                    </div>
                    <span class="error_event_date_from qerr"></span>
                </div>
            </div>
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">Check Out</div>
                <div class="col-sm-9 col-7">
                    <div class="row">
                        <div class="col-sm-6" style="position: relative">
                        <input type="text" class="form-control bg-white" id="datepicker2" class="datepicker" name="event_date_to" readonly>
                            <img src="{{asset('images/icons/calender.png')}}" id="seedate2" onclick="dateselect('datepicker2')" class="cal-icon">
                        </div>
                    </div>
                    <span class="error_event_date_to qerr"></span>
                </div>
            </div>
        </div>
        <script>
            function flipday(flipper){
                if(flipper.value == "multiple"){
                    document.getElementById("multiday").style.display = "block";
                    document.getElementById("singleday").style.display = "none";
                } else {
                    document.getElementById("singleday").style.display = "block";
                    document.getElementById("multiday").style.display = "none";
                }
            }
        </script>
        
        <div class="mt-5 lbl" style="font-weight: 800">What your event is all about?</div>
        <input type="hidden" name="event_about" value="" id="eventabout">
        <div class="ex1 mt-3 ps-1">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" id="event1" onclick="selectEvent(this)">Afterwork</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" id="event2" onclick="selectEvent(this)">Anniversary</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" id="event3" onclick="selectEvent(this)">Audition</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event4">Auditorium</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event5">Award Ceremony</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event6">Ballroom</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event7">Banquet Room</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event8">Board Meeting</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event9">Boardroom</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event10">Brainstorming</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event11">Celebration</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event12">Class</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event13">Client Meeting</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event14">Coaching Session</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event15">Cocktail Party</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event16">Company Party</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event17">Conference</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event18">Conference Room</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event19">Convention</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event20">Corporate Event</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event21">Corporate Meeting</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event22">Corporate Party</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event23">Creative Meeting</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event24">Dinner</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event25">Event Venue</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event26">Expo</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event27">Fair</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event28">Fashion Shoot</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event29">Film Shoot</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event30">Film Studio</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event31">Gala</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" style="padding-left: 10px; padding-right: 10px" id="event32">Group Work Session</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event33">Hackathon</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event34">Happy Hour</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event35">Kick Off Meeting</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event36">Launch Event</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event37">Meeting</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event38">Mixer</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event39">Networking</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event40">Networking Event</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event41">Off-Site</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event42">Outdoor Event</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event43">Outdoor Party</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event44">Outdoor Venues</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event45">Party</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event46">Party Hall</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event47">Photo Shoot</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event48">Press Conference</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event49">Private Dining</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event50">Product Shoot</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event51">Production Studio</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event52">Reception</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event53">Retreat</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event54">Rooftop</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event55">Seminar</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event56">Summit</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" style="padding-left: 10px; padding-right: 10px" id="event57">Team Building Event</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event58">Trade Show</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event59">Training</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event60">Video Shoot</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event61">Video Studio</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event62">Workshop</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2">
                    <div class="card vec" onclick="selectEvent(this)" id="event63">Wedding</div>
                </div>
            </div>
        </div>
        <span class="error_event_about qerr"></span>
        <div class="card titlehead mt-3">Venue Details</div>
        <div class="mt-5 lbl" style="font-weight: 800">Enter your address</div>
        <div id="mappie">
            <div class="width-adjust">
                
                <div class="mt-2 w-100">
                    <input type="text" class="form-control" id="autocomplete" name="event_map_address" placeholder="Enter event address">
                    <span class="error_event_map_address qerr"></span>
                </div>
                <div id="maphere" class="mt-3" style="width:100%; height: 300px"></div>
                <div class="mt-2 lbl" style="color: blue; text-decoration: underline;" onclick="addrForm()">Address not
                    available in map?</div>
            </div>
        </div>
        <div id="addrForm" style="display: none">
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">Address Line 1</div>
                <div class="col-sm-9 col-7"><input type="text" name="address1" class="form-control"></div>
                <span class="error_address1 qerr"></span>
            </div>
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">Address Line 2</div>
                <div class="col-sm-9 col-7"><input type="text" name="address2" class="form-control"></div>
                <span class="error_address2 qerr"></span>
            </div>
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">Country</div>
                <div class="col-sm-9 col-7">
                    <select id="country" name="country" class="form-control">
                        <option value="" >seleect country</option>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
                <span class="error_country qerr"></span>
            </div>
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">State</div>
                <div class="col-sm-9 col-7">
                    <select type="text" id="state" name="state" class="form-control">
                    <select>
                </div>
                <span class="error_state qerr"></span>
            </div>
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">ZIP Code</div>
                <div class="col-sm-9 col-7">
                    <input type="number" name="zipcode" class="form-control">
                    <span class="error_zipcode qerr"></span>
                </div>
            </div>
            <button type="button" class="bluebutton mt-3" onclick="addrMap()">Cancel</button>
        </div>
        <div class="mt-5 lbl" style="font-weight: 800">Maximum No. of Guest</div>
        <div class="row width-adjust mt-2">
            <div class="col-sm-5">
                <input type="text" class="form-control" name="max_no_of_guest">
                <span class="error_max_no_of_guest qerr"></span>
            </div>
        </div>
		<div class="eventDetailsStatusMsg"></div>
		
        <div class="mt-4 mb-3">
            <button type="submit" id="eventDetailsBtn" class="btn bluebutton">Save & next</button>
        </div>
    </form>
</div>
<script>
    /* $(function () {
        $("#datepicker").datepicker();

        $("#seedate").on('click', function () {
            $("#datepicker").datepicker("show");
        });
    }); */

    function addrForm() {
        document.getElementById("addrForm").style.display = "block";
        document.getElementById("mappie").style.display = "none";
    }

    function addrMap() {
        document.getElementById("mappie").style.display = "block";
        document.getElementById("addrForm").style.display = "none";
    }

    function selectEvent(evt){
        document.getElementById("eventabout").value = evt.innerHTML;
        for(i=1; i<=63; i++){
            var enm = "event" + i;
            document.getElementById(enm).style.backgroundColor = "white";
            document.getElementById(enm).style.color = "black";
            evt.style.backgroundColor = "#07269B";
            evt.style.color = "white";
        }
    }
        
</script>

<script>

    let autocomplete;
    function initAutocomplete() {

      let map = new google.maps.Map(document.getElementById("maphere"), {
        zoom: 4,
        center: {
          lat: 42.7199284,
          lng: -78.4103352
        },
        scrollwheel: true //it can zoom in and zoom out using mouse
      });

      let marker = new google.maps.Marker({
        map: map
      });


      autocomplete = new google.maps.places.Autocomplete(
        document.getElementById("autocomplete"), {
        types: ['establishment'],
        componentResrtictions: { 'country': ['AU'] },
        fields: ['place_id', 'geometry', 'name']
      });

      autocomplete.bindTo('bounds', map);
      autocomplete.addListener('place_changed', onPlaceChanged);


      function onPlaceChanged() {
        marker.setVisible(false);
        var place = autocomplete.getPlace();

        if (!place.geometry) {
          //user did not select a prediction. Reset the input field.
          document.getElementById('autocomplete').placeholder = 'Enter a place';
          window.alert('Enter address manually');
          return;
        }
        //display details about the valid place
        // document.getElementById('details').innerHTML = place.name;
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          map.setZoom(17);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
      }
    }
  </script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC8UYJzlbQWQJ0WRATn-_mubFcp9pgI2I&libraries=places&callback=initAutocomplete"
    async differ></script>

<script>
    $('#eventDetails').submit(function (stay) {
        $('.qerr').html('');
        $('.eventDetailsStatusMsg').html('');
       
        var formdata=$(this).serialize();
        $.ajax({
                type: "POST",
                url: "{{url('/add-event-details')}}",
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
                        $('#eventDetailsBtn').hide();
                        $('#event_id').val(response.event.id);
                        $('#hotel_name').val(response.event.event_map_address);
                        $('.eventDetailsStatusMsg').html('<div class="card successcard">'+response.msg+'</div>');
                        $("#cimg1").attr("src","{{asset('images/icons/grey-tick-icon-checked.png')}}");
                    }                  
                    
                }

            });
            stay.preventDefault();
    });
</script>
<script>
    $(function(){
		var dateFormat = "mm/dd/yy",
        pd = $("#datepicker").datepicker({ 
            minDate: 1, 
            //maxDate: "+1M +10D" 
        })
		.on( "change", function() {
			canDate.datepicker( "option", "maxDate", getDate( this ) );
			//console.log(getDate( this ));
		});
		
		function getDate( element ) {
      var date;
			var date1 = element.value;
			var newdate = new Date(date1);

		newdate.setDate(newdate.getDate() - 15);
		var formattedDate = [newdate.getMonth() +1 , newdate.getDate(), newdate.getFullYear()].join('/');
		console.log(formattedDate);	
      try {
        date = $.datepicker.parseDate( dateFormat, formattedDate);
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
    });

    function dateselect(datep){
        $("#" + datep).datepicker("show"); // 1,2
    }
</script>

<script>
  $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#datepicker1" )
        .datepicker({
          minDate: 1, 
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
			canDate.datepicker( "option", "maxDate", getallDate( this ) );
        }),
      to = $( "#datepicker2" ).datepicker({
        minDate: 1, 
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
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
	  
	function getallDate(element){
		var date
	var date1 = element.value;
		var newdate = new Date(date1);

		newdate.setDate(newdate.getDate() - 15);
		var formattedDate = [newdate.getMonth() +1 , newdate.getDate(), newdate.getFullYear()].join('/');
		try {
        date = $.datepicker.parseDate( dateFormat, formattedDate);
      } catch( error ) {
        date = null;
      }
 
      return date;
	}
  } );
  </script>
		
		
<script>
    $('#country').on('change', function(){
        var cid = $(this).val();
        $.ajax({
            type:'GET',
            url:"{{url('get_state')}}",
            data:'country_id='+cid,
            success: function(response) {                
                $('#state').html('');                   
                $.each(response.data,function (i, state){                  
                    $('#state').append('<option value='+state.id+'>'+state.name+'</option>');                                     
                });            
               
            }
        });
    });
</script>
                    <!-- event details end -->
                