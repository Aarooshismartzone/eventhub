<div class="system-view">
    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <div class="toptitle">Leisure Group Tech</div>
        <hr class="hr1">
        @if(auth()->user()->user_type=='admin')
        <a class="nav-link {{request()->is('admin') ? 'active' : ''}}"  href="{{url('/admin')}}"  onclick="imageChange(this)"><img
                src="{{asset('images/icons/dashboard-selected.png')}}" class="nav-icon ">Dashboard</a>
        <a class="nav-link {{request()->is('admin/companies') ? 'active' : ''}}" href="{{url('/admin/companies')}}"  onclick="imageChange()"><img src="{{asset('images/icons/compinfo.png')}}"  class="nav-icon" id="compinfo">Companies</a>
        
        <a class="nav-link {{request()->is('admin/users') ? 'active' : ''}}" href="{{url('/admin/users')}}" onclick="imageChange(this)"><img src="{{asset('images/icons/subscription.png')}}" class="nav-icon" id="bookings">Users</a>

        <a class="nav-link {{request()->is('admin/events') ? 'active' : ''}}" href="{{url('/admin/events')}}" onclick="imageChange(this)"><img src="{{asset('images/icons/events.png')}}" class="nav-icon"
                style="width: 30px; margin-right: 14px;" id="events">Events</a>
                

		<div class="navbottom">
        <a href="{{url('/admin/logout')}}"><img src="{{asset('images/icons/logout-icon.png')}}" class="imageicon2"> 
            <span class="lbl" style="font-weight: bold; color: white">Logout</span>
        </a>
			<div style="font-size: 9px">
            <span style="font-size: 14px">©</span> 2024 Leisure Group Tech<br>All Rights Reserved.
        </div>
		</div>
        @elseif(auth()->user()->user_type=='company')
        <a class="nav-link {{request()->is('company') ? 'active' : ''}}"  href="{{url('/company')}}"  onclick="imageChange(this)"><img
                src="{{asset('images/icons/dashboard-selected.png')}}" class="nav-icon ">Dashboard</a>
        <a class="nav-link {{request()->is('company/info') ? 'active' : ''}}" href="{{url('company/info')}}"  onclick="imageChange(this)"><img src="{{asset('images/icons/compinfo.png')}}"  class="nav-icon" id="compinfo">Company Info</a>
        
        <a class="nav-link {{request()->is('company/event-list') ? 'active' : ''}}" href="{{url('/company/event-list')}}" onclick="imageChange(this)"><img src="{{asset('images/icons/events.png')}}" class="nav-icon"
                style="width: 30px; margin-right: 14px;" id="events">Events</a>
                
        <a class="nav-link {{request()->is('company/booking-list') ? 'active' : ''}}" href="{{url('/company/booking-list')}}" onclick="imageChange(this)"><img src="{{asset('images/icons/sales.png')}}" class="nav-icon" id="bookings">Sales</a>

        <a class="nav-link {{request()->is('company/subscription') ? 'active' : ''}}" href="{{url('/company/subscription')}}"onclick="imageChange(this)"><img src="{{asset('images/icons/subscription.png')}}"  class="nav-icon" id="subscription">Subscription</a>

		<div class="navbottom">
        <a href="{{url('/company/logout')}}"><img src="{{asset('images/icons/logout-icon.png')}}" class="imageicon2"> 
            <span class="lbl" style="font-weight: bold; color: white; text-decoration: none">Logout</span>
        </a>
			<div style="font-size: 9px">
            <span style="font-size: 14px">©</span> 2024 Leisure Group Tech<br>All Rights Reserved.
        </div>
		</div>
        @else

        <a class="nav-link {{request()->is('user') ? 'active' : ''}}"  href="{{url('/user')}}"  onclick="imageChange(this)"><img
                src="{{asset('images/icons/dashboard-selected.png')}}" class="nav-icon {{request()->is('/company') ? 'active' : ''}}">Dashboard</a>
        
        
        <a class="nav-link {{request()->is('user/event-list') ? 'active' : ''}}" href="{{url('/user/event-list')}}" onclick="imageChange(this)"><img src="{{asset('images/icons/events.png')}}" class="nav-icon"
                style="width: 30px; margin-right: 14px;" id="events">Events</a>                
       
	<div class="navbottom">
        <a href="{{url('/user/logout')}}">
			
			<img src="{{asset('images/icons/logout-icon.png')}}" class="imageicon2"> 
				<span class="lbl" style="font-weight: bold; color: white">Logout</span>
        </a>
		<div style="font-size: 9px">
            <span style="font-size: 14px">©</span> 2024 Leisure Group Tech<br>All Rights Reserved.
        </div>
		</div>

        @endif

        
    </div>
</div>

<!-- mobile view of pills inside offcanvas -->

<div class="mobile-view">

    <div class="offcanvas offcanvas-start" data-bs-backdrop="false" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                <a class="nav-link active" href="{{url('/company')}}" onclick="imageChange()"><img
                src="{{asset('images/icons/dashboard-selected.png')}}" class="nav-icon"
                id="dashboard">Dashboard</a>
        <a class="nav-link" href="{{url('/company/info')}}" onclick="imageChange()"><img src="{{asset('images/icons/compinfo.png')}}"
                class="nav-icon" id="compinfo">Company Info</a>
        <button class="nav-link" id="v-pills-events-tab" data-bs-toggle="pill" data-bs-target="#v-pills-events"
            type="button" role="tab" aria-controls="v-pills-events" aria-selected="false"
            onclick="imageChange()"><img src="{{asset('images/icons/events.png')}}" class="nav-icon"
                style="width: 30px; margin-right: 14px;" id="events">Events</button>
        <button class="nav-link" id="v-pills-subscription-tab" data-bs-toggle="pill"
            data-bs-target="#v-pills-subscription" type="button" role="tab" aria-controls="v-pills-subscription"
            aria-selected="false" onclick="imageChange()"><img src="{{asset('images/icons/subscription.png')}}"
                class="nav-icon" id="subscription">Subscription</button>
                <div class="navbottom">
						<div style="position: relative">
                    <img src="{{asset('images/icons/logout-icon.png')}}" class="imageicon2"> 
						<span class="lbl" style="font-weight: bold; color: white">Logout</span>
                    <div style="font-size: 9px; margin-top: 30px;"><span style="font-size: 14px">©</span> 2024 Leisure Group Tech<br>
                        All Rights Reserved. </div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>