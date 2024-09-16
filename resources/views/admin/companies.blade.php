@extends('layouts.master')

@section('content')
<h5 class="ct mt-4">Manage Companies</h5><hr>
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
      <th scope="col">Company</th>
      <th scope="col">Package</th>
      <th scope="col">Amount</th>
      <th scope="col">No. of Events</th>
      <th scope="col">Users</th>
      <th scope="col">Events</th>
      <th scope="col">More</th>
    </tr>
  </thead>
  <tbody>
    @foreach($companies as $k=>$company)
    <tr>
      @php

        $events=DB::table('events')->where([['company_id',$company->id],['status',1]])->pluck('id');
        $bookings=DB::table('bookings')->whereIn('event_id',$events)->get();
        
        $subs=DB::table('subscriptions')->where([['company_id',$company->id],['status',1]])->first();
        
      @endphp
      <td>{{$company->companyInfo()->company_name}}</td>
      <td>Package-0{{$subs->package_id}}</td>
      <td style="color: green; font-weight:bold">{{round($subs->amount,2)}}$</td>
      <td>{{$events->count()}}</td>
      <td>{{$bookings->count()}}</td>
      <td><a href="{{url('company/landingpage?company=').$company->id}}" style="color: #07269B" target="_blank">View</a>&nbsp; &nbsp;
        &nbsp; <i class="fa-solid fa-arrow-up-right-from-square" style="color: #07269B"></i></td>
      <td><span style="color: #07269B" data-bs-toggle="modal" data-bs-target="#exampleModal{{$k}}">Company Info</span>&nbsp; &nbsp; &nbsp; <i
          class="fa-solid fa-arrow-up-right-from-square" style="color: #07269B" onClick="getCompany"></i></td>
    </tr>
    
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$k}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-5">
      <div class="text-end lbl">Download as PDF <img src="{{asset('images/icons/download.png')}}" style="width: 30px;"></div>
      <h5 class="ct">{{$company->companyInfo()->company_name}}</h5>
      <div class="card titlehead mt-4">Contact Info</div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Account Holder Name</div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->account_holder_name}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Email Address</div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->email}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Mobile</div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->mobile}}</div>
      </div>
      <div class="card titlehead mt-4">Company Info</div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Company Legal Name
        </div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->company_name}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Job Title</div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->job_title}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Services Offered</div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->service_offered}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">VAT/BIN</div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->vat}}</div>
      </div>
      <div class="card titlehead mt-4" style="min-width: 200px">Company Address</div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Company Address</div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->company_address}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">Country</div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->country}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">City
        </div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->city}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">State</div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->state}}</div>
      </div>
      <div class="row mt-3">
        <div class="col-5 mt-2 lbl" style="font-weight:bold">ZIP Code</div>
        <div class="col-7 mt-2 lbl">{{$company->companyInfo()->zipcode}}</div>
      </div>
    </div>
  </div>
</div>
@endforeach
  </tbody>
</table>
@endsection