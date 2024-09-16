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
		<div class="container">
        <div class="row">
            <div class="col-sm-6 col-12 pt-5 pb-5">
                <img src="{{url('images/'.$event->logo)}}" style="width: 250px; height: auto">
            </div>
            <div class="col-sm-6 col-12 pt-5 pb-5 text-end text-white">
                Powered by – Leisure Group Tech
            </div>
        </div>
		</div>
    </div>
    <div class="container mt-5 mb-5">
        <h4 class="ct">{{$event->event_name}}</h4>
        <div class="evt mt-3 mb-3">
            <img src="{{asset('images/icons/location.png')}}" style="width: 18px;">  {{$event->event_map_address ? $event->event_map_address : ($event->state.','.$event->country) }}
        </div>
        <div class="row">
           <!-- <div class="col-md-9 col-sm-8 col-12">
                <img src="{{url('images/'.$event->feature_image)}}" class="slider">
            </div>
            <div class="col-md-3 col-sm-4 col-12 ps-2">
                @foreach($images as $image)
                <img src="{{asset('images/'.$image->image)}}" style="width: 100%; height: 100px; margin-bottom: 10px">
                @endforeach
                 <img src="{{asset('images/hotel.jpg')}}" style="width: 100%; height: 190px; margin-top: 10px"> 
            </div> -->
			
			<div class="col-12">
			
				<!--carousel-->
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{url('images/'.$event->feature_image)}}" class="d-block w-100" alt="...">
    </div>
	  @foreach($images as $image)
    <div class="carousel-item">
      <img src="{{asset('images/'.$image->image)}}" class="d-block w-100" alt="...">
    </div>
	  @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
			
			</div>
			
        </div>
        <div class="mt-3">
            <h5 style="font-weight: bold">About The Event</h5>
        </div>
        <div class="mt-3">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-12" style="text-align: justify">
                {{$event->page_about}}
                    <!-- <p class="lbl">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit animid est laborum
                        </p>
                    <p class="lbl">ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                        sunt in culpa qui officia deserunt mollit animid est laborum
                        </p> -->
                    <hr class="mt-3">
                </div>
				<div class="col-md-3 col-sm-4 col-12">
				@if(auth()->user()->user_type=='user')
            		<a href="{{url('/user/event',['id'=>$event->id])}}" class="btn editbtn">Book</a>
        		@endif
				</div>
            </div>
        </div>
    </div>
    @include('footer')
</body>

</html>