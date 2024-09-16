<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts/partials/head')
    <title>LGT - Company</title>
    <style>
        .evt{
            font-weight: 18px;
            color: rgb(61, 61, 61);
        }
    </style>
</head>

<body style="font-family: 'montserrat', sans-serif;">
<div class="bluetop">
    <h5 class="p-4" style="font-weight: 800; color: white">Leisure Group Tech</h5>
</div>
<div class="container mt-5 mb-5">
    <h4 class="ct">Lorem ipsum dolor</h4>
    <div class="evt mt-3">sit amet, consectetur</div>
    <div class="row mt-4">
        <div class="col-md-2 col-sm-4 col-6 p-1" style="position: relative">
            <select class="form-control form-select">
                <option>Event Type</option>
                <option>Single Day</option>
                <option>Multi Day</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-4 col-6 p-1" style="position: relative">
            <input type="text" class="form-control" placeholder="Price">
            <img src="{{asset('images/icons/calender.png')}}" class="cal-icon-2">
        </div>
        <div class="col-md-2 col-sm-4 col-12 p-1" style="position: relative">
            <select class="form-control form-select">
                <option>Location</option>
                <option>Single Day</option>
                <option>Multi Day</option>
            </select>
        </div>
    </div>
    <div class="row mt-2">
        @foreach($events as $event)        
         <div class="col-md-4 col-sm-6 col-12 p-2 pt-3">
			<div class="card hcard">
			<a href="{{url('/event').'/'.(strtolower(str_replace(' ','-',$event->companyLegalName()))).'/'.$event->page_slug}}" target="_blank" style="color:inherit; text-decoration:none">
            
                <img src="{{url('images/'.$event->feature_image)}}" class="card-img-top" alt="...">
                <h5 class="card-title mt-3 cttl">{{$event->event_name}}</h5>
                {{--<p class="card-text">{{$event->page_title}}</p>--}}
                <hr>
				@php
				$price_per_adult=DB::table('event_packages')->where('event_id',$event->id)->pluck('price_per_adult')->first();
				@endphp
                <p class="card-text"><span style="font-size: 22px; font-weight: bold; color: black">{{$price_per_adult}}$</span> / Per Person</p>
           
			</a>
				 </div>
        </div>
        @endforeach
        
        
    </div>
</div>
@include('footer')
</body>

</html>