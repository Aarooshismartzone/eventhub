@extends('layouts.master')

@section('content')
@php
    $event=App\Models\Event::where('id',$id)->first();
    $packages=DB::table('event_packages')->where('event_id',$event->id)->get();
    $image=DB::table('event_images')->where('event_id',$event->id)->pluck('image')->first();
@endphp
<div class="row w-100 mt-4">
    <div class="col-sm-9 col-12 d-sm-block d-none">
        <h5 class="ct">Register for the Event</h5>
    </div>
    <div class="col-sm-3 col-12 text-center">
        <div class="box">{{$event->event_name}}</div>
    </div>
</div>
<hr>

    <div class="accordion" id="accordionExample">
    {{--<form method="post" id="bookingForm"  enctype="multipart/form-data">
        @csrf--}}
        
        {{--<input type="hidden" value="{{$id}}" name="event_id">--}}
        <div class="accordion-item mt-3">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" style="background-color: white; color: #07269B; position: relative" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Contact Info & Address
                    <img id="cimg1" src="{{asset('images/icons/grey-tick-icon.png')}}" class="tickicon">
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @include('user/events/contactinfo')
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" style="background-color: white; color: #07269B;" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Event & Room Details
                    <img id="cimg2" src="{{asset('images/icons/grey-tick-icon.png')}}" class="tickicon">
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @include('user/events/eventandroomdetails')
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" style="background-color: white; color: #07269B;" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Room Booking
                    <img id="cimg3" src="{{asset('images/icons/grey-tick-icon.png')}}" class="tickicon">
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @include('user/events/roombooking')
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" style="background-color: white; color: #07269B;" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Traveler Details
                    <img id="cimg4" src="{{asset('images/icons/grey-tick-icon.png')}}" class="tickicon">
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @include('user/events/travelerdetails')
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" style="background-color: white; color: #07269B;" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Acknowledgement & Policies
                    <img id="cimg5" src="{{asset('images/icons/grey-tick-icon.png')}}" class="tickicon">
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @include('user/events/acknowledgementandpolicies')
                </div>
            </div>
        </div>
    {{--</form>--}}
    <form method="post" action="{{url('/payment')}}"  enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$id}}" name="event_id">
        <input type="hidden" value="" id="booking_id" name="booking_id">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" style="background-color: white; color: #07269B;" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    Payment Module & Details
                    <img src="{{asset('images/icons/grey-tick-icon.png')}}" class="tickicon">
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @include('user/events/paymentmoduleanddetails')
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script> -->
<script>
     
    $("input[name='is_ext']").click(function() {
        if (this.value == 'yes') {
            $('#extendDiv').show();
        }
        else if (this.value == 'no') {
            $('#extendDiv').hide();
        }
        else{
            $('#extendDiv').hide();
        }
    });

    $("input[name='is_share_room']").click(function() {
        if (this.value == 'yes') {
            $('#rmdet').show();
        }
        else if (this.value == 'no') {
            $('#rmdet').hide();
        }
        else{
            $('#rmdet').hide();
        }
    });
    
</script>
<script>
    
    $('#bookingForm').submit(function (stay) {
    //    alert(101);
        var formdata=$(this).serialize();
        $.ajax({
                type: "POST",
                url: "{{url('/booking')}}",
                data:formdata,
                cache: true,
                success: function(response){
                    if(response.event_countdown_days > 30)
                    {
                        $('#installmentDiv').show();
                        $('#instDetails').html("Total Payment - $"+response.full_payment+"<br>Installments available - $9<br>Single Installment - $"+(response.full_payment - response.minimum_payment)+"/9 = $"+((response.full_payment - response.minimum_payment)/9));
                    }else{
                        $('#installmentDiv').hide();
                    }
                    $('#booking_id').val(response.bookingId);
                    $('#full_payment').val(response.full_payment);
                    $('#minimum_payment').val(response.minimum_payment);
                    
                    $('#fullPaymentDiv').html(response.full_payment);          
                             
                    
                }

            });
            stay.preventDefault();
    });
</script>