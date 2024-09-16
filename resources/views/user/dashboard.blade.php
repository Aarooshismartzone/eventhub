@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-sm-4 col-12 p-4">
		<div class="card p-2" style="background-color: #07269b; color: white; box-shadow: 3px 3px 2px grey;">
			<p>No. of Events</p>
			<h3>20</h3>
		</div>
	</div>
	<div class="col-sm-4 col-12 p-4">
	<div class="card p-2" style="background-color: #07269b; color: white; box-shadow: 3px 3px 2px grey;">
			<p>Total Sales Amount</p>
			<h3>$200,000</h3>
		</div>
	</div>
	<div class="col-sm-4 col-12 p-4">
	<div class="card p-2" style="background-color: #07269b; color: white; box-shadow: 3px 3px 2px grey;">
			<p>Net Increase in Sales</p>
			<h3>$36,000</h3>
		</div>
	</div>
</div>
<div class="row mt-3 w-100">
    <div class="col-8 p-2">
        <canvas id="myChart" style="width:100%;">
        </canvas>
    </div>
</div>
<script>
  const ctx = $('#myChart');
  
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Total bookings done',
        data: [5, 8, 10, 11, 13, 15, 16, 19, 22, 28, 36, 42],
        backgroundColor: '#07269b',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endsection