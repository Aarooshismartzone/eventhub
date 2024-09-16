@extends('layouts.master')

@section('content')
<h5 class="ct mt-4">Manage Events</h5>
<hr>
<form method="get" action="{{url('/admin/events')}}" name="search">
    <div class="row mt-3">
      <div class="col-md-3">
        <select name="event_type"  class="form-control form-select" style="height: 37px;">
          <option value="">Event Type</option>          
          <option value="single">Single Day</option>
          <option value="multiple">Multi Day</option>
        </select>
      </div>
      <div class="col-md-3" style="position: relative">
         <input type="date" name="date_from" placeholder="From Date" class="form-control bg-white" id="datepickerFrom" class="datepicker" readonly>
		  <img src="{{asset('images/icons/calender.png')}}" onclick="dateselect('datepickerFrom')" class="cal-icon" id="seedate1">
      </div>
      <div class="col-md-3" style="position: relative">
         <input type="date" name="date_to"  placeholder="To Date" class="form-control bg-white" id="datepickerTo" class="datepicker" readonly>
		  <img src="{{asset('images/icons/calender.png')}}" onclick="dateselect('datepickerTo')" class="cal-icon" id="seedate1">
      </div>
      <div class="col-md-3">
         <button type="submit"  class="btn btn-block btn-sm editbtn" placeholder="Date" style="height: 37px;">Apply Filter</button>
		</div>
	</div>
</form>
<table id="myTablePackages" class="table mt-4 lbl display nowrap">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">From date</th>
            <th scope="col">To date</th>
            <th scope="col">Event type</th>
            <th scope="col">Event by</th>
            <th scope="col">More</th>
            <th scope="col">No. of Bookings</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        @php
        $bookings=DB::table('bookings')->where('event_id',$event->id)->get();
        @endphp
        <tr>
            <td>{{$event->event_name}}</td>
            <td>{{$event->event_date_from}}</td>
            <td>{{$event->event_date_to}}</td>
            <td>{{$event->event_about}}</td>
            <td style="color: #07269B; font-weight:bold">{{$event->companyLegalName()}}</td>
            <td><a href="{{url('/event').'/'.(strtolower(str_replace(' ','-',$event->companyLegalName()))).'/'.$event->page_slug}}" target="_blank" style="color: #07269B">View</a>&nbsp; &nbsp; &nbsp; <i
                    class="fa-solid fa-arrow-up-right-from-square" style="color: #07269B"></i></td>
            <td style="color: #07269B; font-weight:bold">{{$bookings->count()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection