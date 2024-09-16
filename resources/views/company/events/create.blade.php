@extends('layouts.master')
@section('content')
<div class="row w-100 mt-4">
    <div class="col-sm-9 col-12 d-sm-block d-none">
        <h5 class="ct">Events</h5>
    </div>
    {{--<div class="col-sm-3 col-12 text-center">
        <div class="box">World Travel Group Company Ltd.</div>
    </div>--}}
</div>
<hr>
{{--<form action="{{url('/add-event-details')}}" method="post" enctype="multipart/form-data">
    @csrf--}}
    <div class="accordion" id="accordionExample">
        <div class="accordion-item mt-3">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" style="background-color: white; color: #07269B; position: relative" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Event Details
                    <img id="cimg1" src="{{asset('images/icons/grey-tick-icon.png')}}" class="tickicon">
					{{--<img src="{{asset('images/icons/grey-tick-icon-checked.png')}}" class="tickicon">--}}
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @include('company/events/eventdetails')
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" style="background-color: white; color: #07269B;" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Room And Booking
                    <img id="cimg2" src="{{asset('images/icons/grey-tick-icon.png')}}" class="tickicon">
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @include('company/events/roomandbooking')
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" style="background-color: white; color: #07269B;" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Event Page
                    <img id="cimg3" src="{{asset('images/icons/grey-tick-icon.png')}}" class="tickicon">
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @include('company/events/eventpage')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 p-1">
            <button type="button" class="btn bluebutton eventFbtn" onClick="eventPageFinalSubmit()" style="display:none">Final Submit</button></div>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 p-1">
            <button type="button" class="btn bluebutton eventFbtn" style="background-color: #FF6600; display:none" data-bs-toggle="modal" data-bs-target="#eventPreviewModal" onClick="eventPageFinalPreview()">Preview</button>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 p-1">
            <button type="button" class="btn rounded-pill btn-primary eventFbtn" style="display:none" id="eventPagePreviewBtn" onClick="eventPagePreview()" >Page Preview</button>
        </div>
    </div>
{{--</form>--}}
<div class="modal fade" id="eventPreviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-5">        
            
            <div id="finalPreDiv"></div>
            <!-- <div class="card titlehead mt-4">Event Details</div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Event Name</div>
                <div class="col-7 mt-2 lbl">Amanda Ritwik</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Event Type</div>
                <div class="col-7 mt-2 lbl">amanda@worldtravelcompany.com</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Event Date</div>
                <div class="col-7 mt-2 lbl">+1 2896589654</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Event Time From</div>
                <div class="col-7 mt-2 lbl">+1 2896589654</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Event Time To/div>
                <div class="col-7 mt-2 lbl">+1 2896589654</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Check In</div>
                <div class="col-7 mt-2 lbl">+1 2896589654</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Check Out</div>
                <div class="col-7 mt-2 lbl">+1 2896589654</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">What your event is all about?</div>
                <div class="col-7 mt-2 lbl">+1 2896589654</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Address</div>
                <div class="col-7 mt-2 lbl">+1 2896589654</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Maximum No. of Guest</div>
                <div class="col-7 mt-2 lbl">+1 2896589654</div>
            </div>






            <div class="card titlehead mt-4">Room and Booking Info</div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Hotel/Venue Name</div>
                <div class="col-7 mt-2 lbl">World Travel Group Ltd.</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">No. of Single Occupancy rooms</div>
                <div class="col-7 mt-2 lbl">Business Lead
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">No. of Double Occupancy rooms</div>
                <div class="col-7 mt-2 lbl">Business Lead
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Deposit Amount</div>
                <div class="col-7 mt-2 lbl">Group Travels, Trips</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Deposit Last Date</div>
                <div class="col-7 mt-2 lbl">Group Travels, Trips</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Cancellation Waiver</div>
                <div class="col-7 mt-2 lbl">ZSGDY3487422
                </div>
            </div>
            <div class="card titlehead mt-4" style="min-width: 200px">Packages</div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Package Name</div>
                <div class="col-7 mt-2 lbl">23 Lane, George Street, London
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Adult</div>
                <div class="col-7 mt-2 lbl">United Kingdom</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Adult Extended</div>
                <div class="col-7 mt-2 lbl">London</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Max no. of Adults Allowed</div>
                <div class="col-7 mt-2 lbl">London</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Teenager</div>
                <div class="col-7 mt-2 lbl">United Kingdom</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Teenager Extended</div>
                <div class="col-7 mt-2 lbl">London</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Max no. of Teenager Allowed</div>
                <div class="col-7 mt-2 lbl">London</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Child</div>
                <div class="col-7 mt-2 lbl">United Kingdom</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Child Extended</div>
                <div class="col-7 mt-2 lbl">London</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Max no. of Child Allowed</div>
                <div class="col-7 mt-2 lbl">London</div>
            </div>         -->
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
function eventPageFinalPreview(){
//    var eid=1;	
   var eid=$('#event_id').val();	
   $.ajax({
      type:'get',
      url:"{{url('/getEventDetails?eid=')}}"+eid,
      success:function(response){
        //response.event.event_name
        $('#finalPreDiv').html(
        `<div class="card titlehead mt-4">Event Details</div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Event Name</div>
                <div class="col-7 mt-2 lbl">`+response.event.event_name+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Event Type</div>
                <div class="col-7 mt-2 lbl">`+response.event.event_type+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Event Date</div>
                <div class="col-7 mt-2 lbl">`+response.event.event_date+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Event Time From</div>
                <div class="col-7 mt-2 lbl">`+response.event.event_time_from+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Event Time To</div>
                <div class="col-7 mt-2 lbl">`+response.event.event_time_to+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Check In</div>
                <div class="col-7 mt-2 lbl">`+response.event.event_date_from+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Check Out</div>
                <div class="col-7 mt-2 lbl">`+response.event.event_date_to+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">What your event is all about?</div>
                <div class="col-7 mt-2 lbl">`+response.event.event_about+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Address</div>
                <div class="col-7 mt-2 lbl">`+response.event.event_map_address+','+response.event.city+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Maximum No. of Guest</div>
                <div class="col-7 mt-2 lbl">`+response.event.max_no_of_guest+`</div>
            </div>

            <div class="card titlehead mt-4">Room and Booking Info</div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Hotel/Venue Name</div>
                <div class="col-7 mt-2 lbl">`+response.event.hotel_name+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">No. of Single Occupancy rooms</div>
                <div class="col-7 mt-2 lbl">`+response.event.single_occupancy+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">No. of Double Occupancy rooms</div>
                <div class="col-7 mt-2 lbl">`+response.event.double_occupancy+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Deposit Amount</div>
                <div class="col-7 mt-2 lbl">`+response.event.deposit_amount+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Deposit Last Date</div>
                <div class="col-7 mt-2 lbl">`+response.event.deposit_last_date+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Cancellation Waiver</div>
                <div class="col-7 mt-2 lbl">`+response.event.canc_waiver+`</div>
            </div>
            <div class="card titlehead mt-4" style="min-width: 200px">Packages</div>`);
            $.each(response.packages, function (key, value) {
                $('#finalPreDiv').append(`<div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Package Name</div>
                <div class="col-7 mt-2 lbl">`+value.package_name+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Adult</div>
                <div class="col-7 mt-2 lbl">`+value.price_per_adult+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Adult Extended</div>
                <div class="col-7 mt-2 lbl">`+value.price_per_adult_extended+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Max no. of Adults Allowed</div>
                <div class="col-7 mt-2 lbl">`+value.max_allowed_adult+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Teenager</div>
                <div class="col-7 mt-2 lbl">`+value.price_per_teenager+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Teenager Extended</div>
                <div class="col-7 mt-2 lbl">`+value.price_per_teenager_extended+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Max no. of Teenager Allowed</div>
                <div class="col-7 mt-2 lbl">`+value.max_allowed_teenager+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Child</div>
                <div class="col-7 mt-2 lbl">`+value.price_per_child+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Price Per Child Extended</div>
                <div class="col-7 mt-2 lbl">`+value.price_per_child_extended+`</div>
            </div>
            <div class="row mt-3">
                <div class="col-5 mt-2 lbl" style="font-weight:bold">Max no. of Child Allowed</div>
                <div class="col-7 mt-2 lbl">`+value.max_allowed_child+`</div>
            </div>`);
            })
               
      }
    });
   
 
}
function eventPageFinalSubmit(){
   
    var form = $('#eventPage')[0];		 
    var data = new FormData(form);

    $.ajax({
        type:'POST',
        enctype: 'multipart/form-data',
        processData: false,
        url:"{{ url('/eventPagePreview') }}",
        data:data,
        contentType: false,
        cache: false,
        timeout: 600000,        
        success:function(response){
            
            if( response.status == true ) {
                location.reload("{{url('/company/event-list')}}");
                // window.location("{{url('/company/event-list')}}");
            }
        
          
        }
    });
 
}
function eventPagePreview(){
    var form = $('#eventPage')[0];		 
    var data = new FormData(form);

    $.ajax({
        type:'POST',
        enctype: 'multipart/form-data',
        processData: false,
        url:"{{ url('/eventPagePreview') }}",
        data:data,
        contentType: false,
        cache: false,
        timeout: 600000,        
        success:function(response){
            
            if( response.status == true ) {
                // window.open("{{ url('/company/event-page') }}/"+response.slug,'_blank');
                window.open("{{ url('/') }}"+response.slug,'_blank');
            }
        
          
        }
    });
 
}

</script>
@endpush