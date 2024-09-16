@extends('layouts.master')

@section('content')
<h5 class="ct mt-4">Upcoming Events & Weddings</h5>
<div class="row w-50 mt-3">
  <div class="col-sm-4 p-2">
    <select name="event-type" id="event_type" class="form-control form-select" onchange="byType(this.value)">
      <option value="">Event Type</option>
      <option value="Coaching Session">Coaching Session</option>
      <option value="Type 1">Type 1</option>
      <option value="Type 2">Type 2</option>
    </select>
  </div>
  <div class="col-sm-4 p-2"><input type="date" name="date" id="event_date" class="form-control" placeholder="Date"
  onchange="byDate(this.value)"></div>
  <div class="col-sm-4 p-2">
    <select name="event-by" id="event_by" class="form-control form-select">
      <option value="">Event By</option>
      <option value="Type 1">Type 1</option>
      <option value="Type 2">Type 2</option>
    </select>
  </div>
</div>
<script>  
  function byType(etype) {
    var t=etype;  
    @php $c="<script>document.write(t);</script>";@endphp
  }
</script>

<table class="table mt-4 lbl">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">From Date</th>
      <th scope="col">To Date</th>
      <th scope="col">Event Type</th>
      <th scope="col">Event By</th>
      <th scope="col">More</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="eventList">
    
    <!-- <tr>
      
      <td>Jamaica Fit Trip</td>
      <td>2nd Aug - 2024</td>
      <td>5th Aug - 2024</td>
      <td>Fit Trip</td>
      <td>Jamaica Fit Trip</td>
      <td><a href="#" style="color: #07269B">View</a>&nbsp; &nbsp; &nbsp; <i
          class="fa-solid fa-arrow-up-right-from-square" style="color: #07269B"></i></td>
      <td><a href="{{url('/user/event')}}" class="btn bookbtn">Book1</a></td>
    </tr> -->
   
  </tbody>
</table>
@endsection
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script> -->
<script>  
  $(document).ready( function () {
    
    
    $.ajax({
      type:'get',
      url:"{{url('/get-eventlist')}}",
      success:function(response){
        $('#eventList').html('');
        $.each(response, function (key, value) {
          if(value.event_type=='single'){
            var date_from=value.event_date;
            var date_to=value.event_date;
          }
          else{
            var date_from=value.event_date_from;
            var date_to=value.event_date_to;
          }
							$('#eventList').append("<tr>\
										<td>"+value.event_name+"</td>\
										<td>"+date_from+"</td>\
										<td>"+date_to+"</td>\
										<td>"+value.event_type+"</td>\
										<td>"+value.company_id+"</td>\
										<td><a href='{{url("/")}}/"+value.page_slug+"' style='color: #07269B'>View</a>&nbsp; &nbsp; &nbsp;<i class='fa-solid fa-arrow-up-right-from-square' style='color: #07269B'></i></td>\
                    <td><a href='{{url("/user/event/")}}/"+ value.id+"' class='btn bookbtn'>Book</a></td></tr>");
						})
      }
    });
  });
  function byType(etype) {
    var t=etype;  
    
    $.ajax({
      type:'get',
      url:"{{url('/get-eventlist?type=')}}"+t,
      success:function(response){
        $('#eventList').html('');
        $.each(response, function (key, value) {

							$('#eventList').append("<tr>\
										<td>"+value.event_name+"</td>\
										<td>"+value.event_date+"</td>\
										<td>"+value.event_date+"</td>\
										<td>"+value.event_type+"</td>\
										<td>"+value.company_id+"</td>\
										<td><a href='{{url("/")}}/"+value.page_slug+"' style='color: #07269B'>View</a>&nbsp; &nbsp; &nbsp;<i class='fa-solid fa-arrow-up-right-from-square' style='color: #07269B'></i></td>\
                    <td><a href='{{url("/user/event/")}}/"+ value.id+"' class='btn bookbtn'>Book</a></td></tr>");
						})
      }
    });
  }

  function byDate(date) {
    var d=date;  
    
    $.ajax({
      type:'get',
      url:"{{url('/get-eventlist?date=')}}"+d,
      success:function(response){
        $('#eventList').html('');
        $.each(response, function (key, value) {
							$('#eventList').append("<tr>\
										<td>"+value.event_name+"</td>\
										<td>"+value.event_date+"</td>\
										<td>"+value.event_date+"</td>\
										<td>"+value.event_type+"</td>\
										<td>"+value.company_id+"</td>\
										<td><a href='{{url("/")}}/"+value.page_slug+"' style='color: #07269B'>View</a>&nbsp; &nbsp; &nbsp;<i class='fa-solid fa-arrow-up-right-from-square' style='color: #07269B'></i></td>\
                    <td><a href='{{url("/user/event/")}}/"+ value.id+"' class='btn bookbtn'>Book</a></td></tr>");
						})
      }
    });
  }


  
</script>