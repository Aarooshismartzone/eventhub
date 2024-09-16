@php
$availableTags=App\Models\Event::where('status',1)->pluck('event_name')->toArray();
//dd($availableTags);
@endphp
<script>
  $( function() {
	  var availableTags =[
	  	@foreach ($availableTags as $w)
			"{{ $w }}",    
		@endforeach
	  ];
    /*
	var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
    ];
	*/
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  </script>
<div class="tab-top-inner">
    <nav style="display: flex; justify-content: space-between;">
        <div>
            <span style="position: relative;"><input type="text" name="search" class="searchit"
                    placeholder="Search Items" id="tags" value="">
               <img src="{{asset('images/icons/search.png')}}" class="searchicon" id="searchicon">
            </span>
        </div>
        <div style="text-align: right">
            <div class="row">
                <div class="col-2" style="position: relative">
                   {{-- @include('layouts/svg/email')
                    <span class="position-absolute badge rounded-pill thisbadge">
                        9
                    </span>--}}
                </div>
                <div class="col-2" style="position: relative">
                   {{-- @include('layouts/svg/bell')
                    <span class="position-absolute badge rounded-pill thisbadge">
                        9
                    </span>--}}
                </div>
                <div class="col-8" style="position: relative; padding-left: 60px">
                    <nav style="display: flex; justify-content: space-evenly">
                        <div>
                            <img src="{{asset('images/profilepics/sample.jpg')}}" class="profpic-top">
                        </div>
                        <div class="user-name">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</div>
                        
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>
<script>
function remIcon(schh){
	if(schh.value == ""){
		document.getElementById("searchicon").style.display = "fixed";
	} else {
		document.getElementById("searchicon").style.display = "none";
	}	
}
</script>