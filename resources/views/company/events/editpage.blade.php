<div class="mt-3" style="font-weight: 800">Event Details</div>

<div class="mt-4">
    <form method="post" enctype="multipart/form-data" id="eventDetails">
        @csrf
        <div class="card titlehead">Create Event</div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Event Name</div>
            <div class="col-sm-9 col-7"><input type="text" name="event_name" class="form-control"></div>
            <span class="error_event_name qerr"></span>
        </div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Event Type</div>
            <div class="col-sm-9 col-7">
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control form-select" name="event_type" onclick="flipday(this)"
                            onchange="flipday(this)">
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
                            <input type="text" class="form-control bg-white" name="event_date" id="datepicker"
                                class="datepicker" readonly>
                            <img src="{{asset('images/icons/calender.png')}}" id="seedate1"
                                onclick="dateselect('datepicker')" class="cal-icon">
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

                            <input type="time" name="event_time_from" id="" class="form-control">
                            <span class="error_event_time_from qerr"></span>
                        </div>

                        <div class="col-sm-6 up1">
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
                            <input type="text" class="form-control bg-white" id="datepicker1" class="datepicker"
                                name="event_date_from">
                            <img src="{{asset('images/icons/calender.png')}}" id="seedate1"
                                onclick="dateselect('datepicker1')" class="cal-icon">
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
                            <input type="text" class="form-control bg-white" id="datepicker2" class="datepicker"
                                name="event_date_to" readonly>
                            <img src="{{asset('images/icons/calender.png')}}" id="seedate2"
                                onclick="dateselect('datepicker2')" class="cal-icon">
                        </div>
                    </div>
                    <span class="error_event_date_to qerr"></span>
                </div>
            </div>
        </div>
        <script>
            function flipday(flipper) {
                if (flipper.value == "multiple") {
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
                    <div class="card vec" onclick="selectEvent(this)" style="padding-left: 10px; padding-right: 10px"
                        id="event32">Group Work Session</div>
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
                    <div class="card vec" onclick="selectEvent(this)" style="padding-left: 10px; padding-right: 10px"
                        id="event57">Team Building Event</div>
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
                    <input type="text" class="form-control" id="autocomplete" name="event_map_address"
                        placeholder="Enter event address">
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
                        <option value="">seleect country</option>
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

        <div class="mt-3" style="font-weight: 800">Room and Booking</div>
        <input type="hidden" name="event_id" id="event_id" value="">
        <div class="card titlehead">Venue & Booking</div>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Hotel/Venue Name</div>
            <div class="col-sm-9 col-7"><input type="text" name="hotel_name" id="hotel_name" class="form-control">
            </div>
            <span class="error_hotel_name qerr"></span>
        </div>


        <div class="row width-adjust">
            <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">No. of Single Occupancy rooms</div>
            <div class="col-md-3 col-sm-9 col-7 mt-3"><input type="number" class="form-control" id="sor"
                    name="single_occupancy" onclick='addRoom();' onkeyup='addRoom();' value="0"></div>
            <span class="error_single_occupancy qerr"></span>
        </div>
        <div class="row width-adjust">
            <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">No. of Double Occupancy rooms</div>
            <div class="col-md-3 col-sm-9 col-7 mt-3"><input type="number" class="form-control" id="dor"
                    name="double_occupancy" onclick='addRoom();' onkeyup='addRoom();' value="0"></div>
            <span class="error_double_occupancy qerr"></span>
        </div>
        <div class="row width-adjust">
            <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Total No. of Rooms</div>
            <div class="col-md-3 col-sm-9 col-7 mt-3"><input type="text" id="tor" class="form-control textblue bg-white"
                    name="total_rooms" readonly></div>
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
                <input type="text" class="form-control bg-white" name="deposit_last_date" id="datepicker3"
                    class="datepicker" readonly>
                <img src="{{asset('images/icons/calender.png')}}" id="seedate1" onclick="dateselect('datepicker3')"
                    class="cal-icon">


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
        <div id="addpackage">
            <div class="row width-adjust mt-3">
                <div class="col-sm-3 col-5 mt-2 lbl">Package Name</div>
                <div class="col-sm-9 col-7"><input type="text" class="form-control" name="package_name[]" required>
                </div>
                <span class="error_package_name[] qerr"></span>
            </div>
            <div class="row width-adjust">
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Adult</div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input type="text"
                            class="form-control" name="price_per_adult[]" required></div>
                </div>
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Adult<br><span class="minitext">Extended</span>
                </div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input type="text"
                            class="form-control" name="price_per_adult_extended[]" required></div>
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
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Teenager<br><span
                        class="minitext">Extended</span>
                </div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input type="text"
                            class="form-control" name="price_per_teenanger_extended[]" required></div>
                </div>
            </div>
            <div class="row width-adjust">
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Max no. of Teenagers Allowed</div>
                <div class="col-md-3 col-sm-9 col-7 mt-3"><input type="text" class="form-control"
                        name="max_allowed_teenager[]" required></div>
            </div>
            <hr class="mt-5 width-adjust">
            <div class="row width-adjust">
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Child/Infant</div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input type="text"
                            class="form-control" name="price_per_child[]" required></div>
                </div>
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Price Per Child/Infant<br><span
                        class="minitext">Extended</span></div>
                <div class="col-md-3 col-sm-9 col-7 mt-3">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">$</span><input type="text"
                            class="form-control" name="price_per_child_extended[]" required></div>
                </div>
            </div>
            <div class="row width-adjust">
                <div class="col-md-3 col-sm-3 col-5 mt-3 lbl">Max no. of Children/ Infants Allowed</div>
                <div class="col-md-3 col-sm-9 col-7 mt-3"><input type="text" class="form-control"
                        name="max_allowed_child[]" required></div>
            </div>
            <hr>
        </div>

        <div id="displaypackageform"></div>
        <div class="roomAndBookingStatusMsg"></div>
        <div class="mt-4 mb-3">
            <button type="submit" class="btn bluebutton" id="roomAndBookingBtn">Save & next</button>
        </div>

        <div class="mt-3" style="font-weight: 800">Event Page</div>
        <input type="hidden" name="event_id" id="event_id1" value="">
        <div class="card titlehead">Page Details</div>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Page Title</div>
            <div class="col-sm-9 col-7">
                <input type="text" class="form-control mt-2" name="page_title" placeholder="Enter post title"
                    onclick="slugCreate(this.value)" onchange="slugCreate(this.value)" required>
                <i style="color: blue"> The page title will appear as the URL of the landing page, and the URL
                    character
                    limit is (20) please, adjust the page title accordingly.</i>
                <span class="error_page_title qerr"></span>
            </div>


        </div>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">URL</div>
            <div class="col-sm-9 col-7">
                <input type="text" class="form-control mt-2" name="page_slug" placeholder="Slug" id="slug" readonly
                    required>
            </div>
            <span class="error_page_slug qerr"></span>
        </div>

        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">About The Event</div>
            <div class="col-sm-9 col-7">
                <textarea class="form-control" rows="5" name="page_about" required></textarea>
            </div>
            <span class="error_page_about qerr"></span>
        </div>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Upload Logo (Types:jpg,jpeg,png. Size: upto 1MB)</div>
            <div class="col-sm-9 col-7">

                <div class="card w-100 filecard" id="filecard">
                    <span class="btn lbl" id="spnFilePath" style="color: white">Choose File</span>
                </div>
            </div>
            <input type="file" name="logo" id="logo" accept="image/*" required style="display:none">
        </div>
        <span class="error_logo qerr"></span>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Upload Feature Image (Types:jpg,jpeg,png. Size: upto 1MB)</div>
            <div class="col-sm-9 col-7">

                <div class="card w-100 filecard" id="featimage"><span class="btn lbl" style="color: white"
                        id="spnFilePath1">Choose File</span></div>
            </div>
            <input type="file" id="featuredimage" accept="image/*" name="feature_image" required style="display:none">
        </div>
        <span class="error_feature_image qerr"></span>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Images of the Venue/Event
            </div>
            <div class="col-sm-9 col-7">
                <input type="file" name="images[]" id="venueimages" multiple required style="display:none"
                    onClick="uploadImages()">
                <div class="card w-100 filecard lbl text-center" id="vibox">
                    <img src="{{asset('images/icons/imageicon.png')}}" class="imageicon mx-auto">
                    Drag & Drop your files here or Select a file
                </div>
                <div class="previewDiv row">

                </div>
            </div>
            <span class="error_images qerr"></span>
        </div>
        <div class="eventPageStatusMsg"></div>
        <div class="mt-4 mb-3">
            <button type="button" class="btn bluebutton" id="eventPageBtn" onClick="eventPageSubmit()">Save &
                next</button>

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

    function selectEvent(evt) {
        document.getElementById("eventabout").value = evt.innerHTML;
        for (i = 1; i <= 63; i++) {
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

        var formdata = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "{{url('/add-event-details')}}",
            data: formdata,
            cache: true,
            success: function (response) {
                if (response.status == false) {

                    $.each(response.errors, function (errors_key, errors_val) {
                        console.log(errors_key, errors_val);
                        $('.error_' + errors_key).html(errors_val[0]).css("color", "red", "display", "show");
                        $(errors_key).text(errors_val[0]);
                    });
                    //$('.eventDetailsStatusMsg').html('<span style="color:red;">'+response.msg+'</p>');
                }
                if (response.status == true) {
                    $('#eventDetailsBtn').hide();
                    $('#event_id').val(response.eventId);
                    $('#hotel_name').val(response.eventName);
                    $('.eventDetailsStatusMsg').html('<div class="card successcard">' + response.msg + '</div>');
                    $("#cimg1").attr("src", "{{asset('images/icons/grey-tick-icon-checked.png')}}");
                }

            }

        });
        stay.preventDefault();
    });
</script>
<script>
    $(function () {
        $("#datepicker").datepicker({
            minDate: 1,
            //maxDate: "+1M +10D" 
        });
        $("#datepicker1").datepicker({
            minDate: 1,
            //maxDate: "+1M +10D" 
        });
        $("#datepicker2").datepicker({
            minDate: 1,
            //maxDate: "+1M +10D" 
        });

        $("#datepicker3").datepicker({
            minDate: 1,
            //maxDate: "+1M +10D" 
        });
    });

    function dateselect(datep) {
        $("#" + datep).datepicker("show");
    }
</script>
<script>
    $('#country').on('change', function () {
        var cid = $(this).val();
        $.ajax({
            type: 'GET',
            url: "{{url('get_state')}}",
            data: 'country_id=' + cid,
            success: function (response) {
                $('#state').html('');
                $.each(response.data, function (i, state) {
                    $('#state').append('<option value=' + state.id + '>' + state.name + '</option>');
                });

            }
        });
    });
</script>
<script>
    var a = document.getElementById("addpackage").innerHTML;
    function addpackage() {
        var init = document.getElementById("displaypackageform").innerHTML;
        document.getElementById("displaypackageform").innerHTML = init + a;
    }
</script>

<script>
    $('#roomAndBooking').submit(function (stay) {
        $('.qerr').html('');
        $('.roomAndBookingStatusMsg').html('');

        var formdata = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "{{url('/add-room-and-booking')}}",
            data: formdata,
            cache: true,
            success: function (response) {
                if (response.status == false) {

                    $.each(response.errors, function (errors_key, errors_val) {
                        console.log(errors_key, errors_val);
                        $('.error_' + errors_key).html(errors_val[0]).css("color", "red", "display", "show");
                        $(errors_key).text(errors_val[0]);
                    });
                    // $('.roomAndBookingStatusMsg').html('<span style="color:red;">'+response.msg+'</p>');
                }
                if (response.status == true) {
                    $('#roomAndBookingBtn').hide();
                    $('#event_id1').val(response.eventId);
                    $('.roomAndBookingStatusMsg').html('<div class="card successcard">' + response.msg + '</div>');
                    $("#cimg2").attr("src", "{{asset('images/icons/grey-tick-icon-checked.png')}}");
                }
            }

        });
        stay.preventDefault();
    });
</script>
<script>
    function addRoom() {
        var sor = parseInt(document.getElementById("sor").value);
        var dor = parseInt(document.getElementById("dor").value);
        document.getElementById("tor").value = (sor + dor);
    }
</script>

<script>
    function slugCreate(title) {
        const kebabCase = str => str
            .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
            .join('-')
            .toLowerCase();
        var rand = Math.floor(Math.random() * 100) + 1;
        var slug = rand + "-" + kebabCase(title);
        document.getElementById("slug").value = slug;
    }
</script>

<script>
    function eventPageSubmit() {
        $('.qerr').html('');
        $('.eventPageStatusMsg').html('');

        var form = $('#eventPage')[0];
        var data = new FormData(form);

        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            processData: false,
            url: "{{ url('/addEventPageDetails') }}",
            data: data,
            contentType: false,
            cache: false,
            timeout: 600000,
            beforeSend: function () {
                $('.eventPageStatusMsg').html('<div class="card successcard">Processing......</div>');

            },
            success: function (response) {
                $("#eventPageBtn").delay(5000);
                $('.eventPageStatusMsg').html('');
                if (response.status == false) {

                    $.each(response.errors, function (errors_key, errors_val) {
                        console.log(errors_key, errors_val);
                        $('.error_' + errors_key).html(errors_val[0]).css("color", "red", "display", "show");
                        $(errors_key).text(errors_val[0]);
                    });
                    // $('.eventPageStatusMsg').html('<span style="color:red;">'+response.msg+'</div>');
                }
                if (response.status == true) {
                    $('#eventPageBtn').hide();
                    // $('#eventPagePreviewBtn').hide();
                    $('.eventFbtn').show();
                    $('.eventPageStatusMsg').html('<div class="card successcard">' + response.msg + '</div>');
                    $("#cimg3").attr("src", "{{asset('images/icons/grey-tick-icon-checked.png')}}");
                }
            }
        });

    }




</script>

<script type="text/javascript">
    window.onload = function () {
        var logo = document.getElementById("logo");
        var filePath = document.getElementById("spnFilePath");
        var button = document.getElementById("filecard");

        var fimg = document.getElementById("featuredimage");
        var featimage = document.getElementById("featimage");
        var filePath1 = document.getElementById("spnFilePath1");

        var venueimages = document.getElementById("venueimages");
        var vibox = document.getElementById("vibox");

        button.onclick = function () {
            logo.click();
        };


        featimage.onclick = function () {
            fimg.click();
        };

        vibox.onclick = function () {
            venueimages.click();
        };

        logo.onchange = function () {
            var fileName = logo.value.split('\\')[logo.value.split('\\').length - 1];
            filePath.innerHTML = "<b>Selected File: </b>" + fileName;
        };

        fimg.onchange = function () {
            var fileName = fimg.value.split('\\')[fimg.value.split('\\').length - 1];
            filePath1.innerHTML = "<b>Selected File: </b>" + fileName;
        };
    };
</script>
<style>
    .thumbnail {
        height: 100px;
        padding: 10px;
        /* margin: 10px; */
    }
</style>
<script>
    $(function() {
        var filesAmount=0;
        
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        $('.previewDiv').html('');
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="col-md-3">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#venueimages').on('change', function() {
        imagesPreview(this, 'div.previewDiv');
    });
});

</script>