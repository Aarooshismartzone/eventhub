@extends('layouts.master')

@section('content')
<h5 class="ct mt-4">Users</h5>
{{--<div class="row w-50 mt-3">
  <div class="col-sm-4 p-2">
    <select name="payment_status" id="payment_status" class="form-control form-select" onchange="byPaymentStatus(this.value)">
      <option value="">Payment Status</option>
      <option value="PAID">Paid</option>
      <option value="DUE">Due</option>      
    </select>
  </div>
  <div class="col-sm-4 p-2"><input type="text" name="booking_date" id="booking_date" class="form-control" placeholder="Date"
      onfocus="this.type = 'date'" onchange="byBookingDate(this.value)"></div>
  <div class="col-sm-4 p-2">
    <select name="event_type" id="ebent_type" class="form-control form-select">
      <option value="">Event Type</option>
      <option value="single">Type 1</option>
      <option value="multiple">Type 2</option>
    </select>
  </div>
</div>--}}
<table class="table mt-4 lbl">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Event</th>
      <th scope="col">Amount</th>
      <th scope="col">Status</th>
      <th scope="col">More</th>
    </tr>
  </thead>
  <tbody >
    @foreach($bookings as $bk)
    <tr>
      <td>{{$bk->name}}</td>
      <td>{{$bk->event_id}}</td>
      <td>{{number_format($bk->amount,2)}}</td>
      <td>{{$bk->payment_status}}</td>
      <td>{{$bk->user_id}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
