<h5 class="mt-3" style="font-weight: 800">Contact Info & Address</h5>
<div class="mt-4 mb-4">
    <form method="post" enctype="multipart/form-data" id="contactInfo">
        @csrf
        <input type="hidden" value="{{$id}}" name="event_id">
        <div class="card titlehead">Contact Info</div>       
        <div class="row mt-3 w-50">
            <div class="col-5 lbl">Legal Name<br><span class="minitext">As it appears in your passport</span></div>
            <div class="col-7"><input type="text" class="form-control" name="name"></div>
            <span class="error_name qerr"></span>
        </div>
        <div class="row mt-3 w-50">
            <div class="col-5 mt-2 lbl">Email Address</div>
            <div class="col-7"><input type="email" class="form-control" name="email"></div>
            <span class="error_email qerr"></span>
        </div>
        <div class="row mt-3 w-50">
            <div class="col-5 mt-2 lbl">Mobile</div>
            <div class="col-7"><input type="text" class="form-control" name="mobile"></div>
            <span class="error_mobile qerr"></span>
        </div>
        <div class="row mt-3 w-50">
            <div class="col-5 mt-2 lbl">How did you get to know
                about us?</div>
            <div class="col-7"><input type="text" class="form-control" name="got_to_know"></div>
        </div>
        <div class="card titlehead mt-4">Address</div>
        <div class="row mt-3 w-50">
            <div class="col-5 mt-2 lbl">Street Address</div>
            <div class="col-7"><input type="text" class="form-control" name="address"></div>
        </div>
        <div class="row mt-3 w-50">
            <div class="col-5 mt-2 lbl">App/ Suite</div>
            <div class="col-7"><input type="text" class="form-control" name="app"></div>
        </div>
        
        <div class="row mt-3 w-50">
            <div class="col-5 mt-2 lbl">Country</div>
            <div class="col-7">
                <select class="form-control form-select" id="country" name="country">
                    <option value="" >select country</option>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3 w-50">
            <div class="col-5 mt-2 lbl">State</div>
            <div class="col-7">
                <select class="form-control form-select" id="state" name="state">
                    
                </select>
            </div>
        </div>
        <div class="row mt-3 w-50">
            <div class="col-5 mt-2 lbl">City</div>
            <div class="col-7"><select class="form-control" id="city" name="city"></select></div>
        </div>
        <div class="row mt-3 w-50">
            <div class="col-5 mt-2 lbl">ZIP Code</div>
            <div class="col-7"><input type="number" class="form-control" name="zipcode"></div>
        </div>
        <div class="contactInfoStatusMsg"></div>
        <div class="mt-3 mb-3">
            <button type="submit" class="btn bluebutton" id="contactInfoBtn">Save & next</button>
        </div>
    </form>
</div>
<script>
$('#contactInfo').submit(function (stay) {
        $('.qerr').html('');
        $('.contactInfoStatusMsg').html('');
       
        var formdata=$(this).serialize();
        $.ajax({
                type: "POST",
                url: "{{url('/booking/contactInfo')}}",
                data:formdata,
                cache: true,
                success: function(response){
                    if( response.status == false ) {
                                     
                        $.each(response.errors, function (errors_key, errors_val) {
                            console.log(errors_key,errors_val);
                            $('.error_'+errors_key).html(errors_val[0]).css("color","red","display","show");
                            $( errors_key ).text(errors_val[0]);
                        });
                        //$('.eventDetailsStatusMsg').html('<span style="color:red;">'+response.msg+'</p>');
                    }
                    if( response.status == true ) {
                        $('#contactInfoBtn').hide();
                        $('#booking_id').val(response.bookingId);                        
                        $('.contactInfoStatusMsg').html('<div class="card successcard">'+response.msg+'</div>');
                        $("#cimg1").attr("src","{{asset('images/icons/grey-tick-icon-checked.png')}}");
                    }                  
                    
                }

            });
            stay.preventDefault();
    });
</script>
<script>
    $('#country').on('change', function(){
        var cid = $(this).val();
        $.ajax({
            type:'GET',
            url:"{{url('get_state')}}",
            data:'country_id='+cid,
            success: function(response) {                
                $('#state').html('');                   
                $.each(response.data,function (i, state){                  
                    $('#state').append('<option value='+state.id+'>'+state.name+'</option>');                                     
                });            
               
            }
        });
    });
    $('#state').on('change', function(){
        var sid = $(this).val();
        $.ajax({
            type:'GET',
            url:"{{url('get_city')}}",
            data:'state_id='+sid,
            success: function(response) {                
                $('#city').html('');                   
                $.each(response.data,function (i, city){                  
                    $('#city').append('<option value='+city.id+'>'+city.name+'</option>');                                     
                });            
               
            }
        });
    });
</script>
