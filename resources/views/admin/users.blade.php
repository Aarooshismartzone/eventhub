@extends('layouts.master')

@section('content')<h5 class="ct mt-4">Manage Users</h5><hr>

{{--<div class="row w-50 mt-3">
  <div class="p-2 col-sm-4">
    <select name="event-type" id="" class="form-control form-select">
      <option value="">Event Type</option>
      <option value="Type 1">Type 1</option>
      <option value="Type 2">Type 2</option>
    </select>
  </div>
  <div class="p-2 col-sm-4"><input type="text" name="date" id="" class="form-control" placeholder="Date"
      onfocus="this.type = 'date'"></div>
  <div class="p-2 col-sm-4">
    <select name="event-by" id="" class="form-control form-select">
      <option value="">Event By</option>
      <option value="Type 1">Type 1</option>
      <option value="Type 2">Type 2</option>
    </select>
  </div>
</div>--}}
<table id="myTablePackages" class="table mt-4 lbl display nowrap">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Company</th>
      <th scope="col">No. of Rooms</th>
      <th scope="col">Total Paid</th>
      <th scope="col">Balance</th>
      <th scope="col">Events</th>
      <th scope="col">More</th>
    </tr>
  </thead>
  <tbody>
    @foreach($bookings as $bk=>$booking)
        @php
          $event=App\Models\Event::where('id',$booking->event_id)->first();
          $user=App\Models\User::where('id',$booking->user_id)->first();
        @endphp
    <tr>
      <td>{{$booking->name}}</td>
      <td>{{$event->companyLegalName()}}</td>
      <td>{{$booking->single_occupancy + $booking->double_occupancy}}</td>
      <td style="color: green; font-weight:bold">{{number_format(($booking->payble_amount), 2)}}$</td>
      <td style="color: #07269B; font-weight:bold">{{number_format(($booking->payble_amount - $booking->amount), 2)}}$</td>
      <td>{{$event->event_name}}</td>
      <td><span style="color: #07269B" data-bs-toggle="modal" data-bs-target="#userModal{{$bk}}">User Info</span>&nbsp; &nbsp; &nbsp; <i
          class="fa-solid fa-arrow-up-right-from-square" style="color: #07269B"></i></td>
    </tr>
    
<!-- Modal -->
<div class="modal fade" id="userModal{{$bk}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-5">
      <div class="text-end lbl">Download as PDF <img src="{{asset('images/icons/download.png')}}" style="width: 30px;"></div>
      <h5 class="ct">{{$booking->name}}</h5>
      <div class="card titlehead mt-4">Contact Info</div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Account Holder Name</div>
        <div class="col-7 mt-2 lbl">{{$booking->name}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Email Address</div>
        <div class="col-7 mt-2 lbl">{{$booking->email}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Mobile</div>
        <div class="col-7 mt-2 lbl">{{$booking->mobile}}</div>
      </div>
      
      
     
      <div class="card titlehead mt-4" style="min-width: 200px">User Address</div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">User Address</div>
              <div class="col-7 mt-2 lbl">{{$booking->address}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Country</div>
        <div class="col-7 mt-2 lbl">{{$booking->country}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">City
        </div>
        <div class="col-7 mt-2 lbl">{{$booking->city}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">State</div>
        <div class="col-7 mt-2 lbl">{{$booking->state}}
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">ZIP Code</div>
        <div class="col-7 mt-2 lbl">{{$booking->zipcode}}</div>
      </div>
    </div>
  </div>
</div>
@endforeach
  </tbody>
</table>
@endsection