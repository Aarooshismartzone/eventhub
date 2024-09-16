@extends('layouts.master')

@section('content')
<div class="row mt-4">
    <div class="col-md-9 col-sm-7 col-12 d-sm-block d-none">
        <h4 class="ct">Company Info</h4>
    </div>
     <!-- <div class="col-md-3 col-sm-5 col-12 text-center">
        <div class="box">World Travel Group Company Ltd.</div>
    </div> -->
</div>
<hr style="width: 100%">

    @if (session('success'))		
        <span class="alert-success"> {{ session('success') }}  </span>
    @elseif(session('error'))
        <span class="alert-danger"> {{ session('error') }}</span>
    @endif
<div class="mt-4">
    
    <form method="post" action="{{url('/company/info-store')}}" enctype= "multipart/form-data">
	@csrf
        <div class="card titlehead">Contact Info</div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Account Holder Name</div>
            <div class="col-sm-9 col-7">
                <input type="text" name="account_holder_name" class="form-control" value="@isset($info){{$info->account_holder_name}}@endif">
            </div>
            @if($errors->has('account_holder_name'))
                <span class="alert-danger">{{$errors->first('account_holder_name')}}</span>
            @endif
        </div>
        <div class="row width-adjust mt-3">
            <div class="col-sm-3 col-5 mt-2 lbl">Email Address</div>
            <div class="col-sm-9 col-7">
                <input type="email" name="email" class="form-control" value="@isset($info){{$info->email}}@endif">
            </div>
            @if($errors->has('email'))
                <span class="alert-danger">{{$errors->first('email')}}</span>
            @endif
        </div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Mobile</div>
            <div class="col-sm-9 col-7">
                <input type="text" name="mobile" class="form-control" value="@isset($info){{$info->mobile}}@endif">
            </div>
            @if($errors->has('mobile'))
                <span class="alert-danger">{{$errors->first('mobile')}}</span>
            @endif
        </div>
        <div class="card titlehead mt-4">Company Info</div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Company Legal Name</div>
            <div class="col-sm-9 col-7">
                <input type="text" name="company_name" class="form-control" value="@isset($info){{$info->company_name}}@else {{auth()->user()->company_legal_name}}@endif">
            </div>
            @if($errors->has('company_name'))
                <span class="alert-danger">{{$errors->first('company_name')}}</span>
            @endif
        </div>
        
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Job Title</div>
            <div class="col-sm-9 col-7">
                <input type="text" name="job_title" class="form-control" value="@isset($info){{$info->job_title}}@endif">
            </div>
            @if($errors->has('job_title'))
                <span class="alert-danger">{{$errors->first('job_title')}}</span>
            @endif
        </div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Services Offered</div>
            <div class="col-sm-9 col-7">
                <input type="text" class="form-control" name="service_offered" value="@isset($info){{$info->service_offered}}@endif">
                
            </div>
            @if($errors->has('service_offered'))
                <span class="alert-danger">{{$errors->first('service_offered')}}</span>
            @endif
        </div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">VAT/BIN</div>
            <div class="col-sm-9 col-7"><input type="text" name="vat" class="form-control" value="@isset($info){{$info->vat}}@endif"></div>
            @if($errors->has('vat'))
                <span class="alert-danger">{{$errors->first('vat')}}</span>
            @endif
        </div>
        <div class="card titlehead mt-4" style="max-width: 200px">Company Address</div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Company Address</div>
            <div class="col-sm-9 col-7">
                <input type="text" name="company_address" class="form-control" value="@isset($info){{$info->company_address}}@endif">
            </div>
            @if($errors->has('company_address'))
                <span class="alert-danger">{{$errors->first('company_address')}}</span>
            @endif
        </div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">Country</div>
            <div class="col-sm-9 col-7">
                <select class="form-control form-select" id="country" name="country">

                    <option value="" >seleect country</option>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}" @isset($info){{$info->country==$country->id ? 'selected':''}}@endif>{{$country->name}}</option>
                    @endforeach
                    
                </select>
            </div>
                @if($errors->has('country'))
                <span class="alert-danger">{{$errors->first('country')}}</span>
            @endif
        </div>
        
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">State</div>
            <div class="col-sm-9 col-7">
                <select class="form-control form-select" id="state" name="state">
                    <option value="" >seleect State</option>                    
                </select>
            </div>
            @if($errors->has('state'))
            <span class="alert-danger">{{$errors->first('state')}}</span>
            @endif
        </div>
        <div class="row mt-3 width-adjust">
            <div class="col-sm-3 col-5 mt-2 lbl">City</div>
            <div class="col-sm-9 col-7">
                <select class="form-control form-select" id="city" name="city">
                    <option value="" >seleect City</option>                    
                    
                </select>
            </div>
            @if($errors->has('city'))
                <span class="alert-danger">{{$errors->first('city')}}</span>
            @endif
        </div>
        <div class="row width-adjust mt-4">
            <div class="col-sm-3 col-5 mt-2 lbl">ZIP Code</div>
            <div class="col-sm-9 col-7">
                <input type="text" class="form-control" name="zipcode" value="@isset($info){{$info->zipcode}}@endif">
            </div>
            @if($errors->has('zipcode'))
                <span class="alert-danger">{{$errors->first('zipcode')}}</span>
            @endif
        </div>
        
        <div class="mt-3" style="display:@isset($info) none @else block @endif">
            <label class="ctr">Do you want to use the same address for Billing?
                {{-- <input name="same_address" id="same_address" type="checkbox" value="yes" onchange="billAddress()"> --}}
                <input type="checkbox" checked onclick="checkbill(this)" name="same_address" value="yes" id="same_address">
                @isset($info)  @else <span class="checkmark"></span> @endif
              </label>
              @if($errors->has('same_address'))
                <span class="alert-danger">{{$errors->first('same_address')}}</span>
            @endif
        </div>
        <div id="billAddress" style="display:@isset($info) block @else none @endif">
            <div class="card titlehead mt-4" style="max-width: 200px">Billing Address</div>
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">Billing Address</div>
                <div class="col-sm-9 col-7">
                    <input type="text" name="billing_address" class="form-control" value="@isset($info){{$info->billing_address}}@endif">
                </div>
                @if($errors->has('billing_address'))
                    <span class="alert-danger">{{$errors->first('billing_address')}}</span>
                @endif
            </div>
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">Country</div>
                <div class="col-sm-9 col-7">
                    <select class="form-control form-select" name="billing_country" id="billing_country">
                        <option value="" >seleect country</option>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}" @isset($info){{$info->billing_country==$country->id ? 'selected':''}}@endif>{{$country->name}}</option>
                        @endforeach

                    </select>
                </div>
                @if($errors->has('billing_country'))
                    <span class="alert-danger">{{$errors->first('billing_country')}}</span>
                @endif
            </div>
            
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">State</div>
                <div class="col-sm-9 col-7">
                    <select class="form-control form-select" name="billing_state" id="billing_state">
                        <option value="">select state</option>
                    </select>
                </div>
                @if($errors->has('billing_state'))
                <span class="alert-danger">{{$errors->first('billing_state')}}</span>
                @endif
            </div>
            <div class="row mt-3 width-adjust">
                <div class="col-sm-3 col-5 mt-2 lbl">City</div>
                <div class="col-sm-9 col-7">
                    <select class="form-control form-select" name="billing_city" id="billing_city">
                        <option value="">select city</option>
                        
                    </select>
                </div>
            </div>
            <div class="row width-adjust mt-4">
                <div class="col-sm-3 col-5 mt-2 lbl">ZIP Code</div>
                <div class="col-sm-9 col-7">
                    <input type="text" class="form-control" name="billing_zipcode" value="@isset($info){{$info->billing_zipcode}}@endif">
                </div>
                @if($errors->has('billing_zipcode'))
                <span class="alert-danger">{{$errors->first('billing_zipcode')}}</span>
            @endif
            </div>
        </div>
        {{-- <div class="mt-4 lbl">
        <b>Billing Address:</b><br><br>
            31a Biscayne Drive, <br>
            W Biscayne Dr, Portmore, <br>
            Jamaica
        </div> --}}
        <script>
            function checkbill(chk){
                if(chk.checked){
                    document.getElementById("billAddress").style.display = "none";
                } else {
                    document.getElementById("billAddress").style.display = "block";
                }
            }
        </script>
       
        <!-- <div class="mt-3">
            <nav style="display: flex; justify-content: left; margin-left: -10px">
                <div><img src="{{asset('images/icons/add-agent.png')}}" alt="" style="width: 50px; height: 60px" onclick="addagent()"></div>
            <div class="mt-3 ms-2">Add Agent</div>
            </nav>
        </div> -->
       
       
        
        <div class="card titlehead mt-4" style="max-width: 200px">Agent Details</div>
        {{-- <span>Default Password for Agent : 'P@ssw0rd'</span> --}}
        <div class="row goods mt-3" > 
            @isset($agents)
            @foreach( $agents as $agc=>$agent)                                                       
            <div class="col-md-4 mb-3">
                <label>Agent Name *</label>
                <input type="text"   class="form-control " value="{{$agent->first_name}}" disabled>
                                                            
            </div>
            <div class="col-md-4 mb-3">
                <label>Agent Email</label>
                <input type="email"    class="form-control" value="{{$agent->email}}" disabled>
                                                            
            </div>
            <div class="col-md-4 mb-3">
               {{-- @if($agc==(($subscription->agent_limit)-1))
                <label>&nbsp;</label>
                <button class="dynamic-goods-btn rounded-pill btn-primary btn-block" type="button" > + Add Agent</button> 
                @endif   --}}                   
            </div> 
            @endforeach
           
            @else
            <div class="col-md-3 mb-3">
                <label>Agent Name 1*</label>
                <input type="text"  id="agent_name"  name="agent_name[]"  class="form-control "  required>
                                                            
            </div>
            <div class="col-md-3 mb-3">
                <label>Agent Email 1*</label>
                <input type="email"  id="agent_email"  name="agent_email[]"  class="form-control"  required>
                                                            
            </div>
            <div class="col-md-3 mb-3">
                <label>Agent Password 1*</label>
                <input type="password"  id="agent_password"  name="agent_password[]"  class="form-control"  required>
                                                            
            </div>
                <div class="col-md-3 mb-3">
                    <label>&nbsp;</label>
                    <button class="dynamic-goods-btn rounded-pill btn-block btn bluebutton mt-3" type="button" > + Add Agent</button> 
                </div>
            <!-- <div class="col-md-4 mb-3">
                <label>&nbsp;</label>
                <button class="dynamic-goods-btn rounded-pill btn-primary btn-block" type="button" > + Add Agent</button>                              [Rahim eta remove korte boleche. Password Email diye jaabe jar jonne future a phpmailer lagabe]
            </div> -->
            @endif

            
        </div>
        
        <div class="mt-3">
            <button type="submit" class="btn bluebutton">Submit</button>
        </div>
    </form>
</div>
<script>
    
    $(document).ready(function() {
        var max_fields      = {{(($subscription->agent_limit)-1)}}; //maximum input boxes allowed
        var wrapper   		= $(".goods"); //Fields wrapper
        var add_button      = $(".dynamic-goods-btn"); //Add button ID
        
        var x = @isset($agents){{count($agents)}}@else 0 @endif; //initlal text box count
        var lc=x+1;
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                lc++; //lebel increment
                
                 $(wrapper).append('<div class="row add_div"><div class="col-md-3"><label>Agent Name '+ lc +'</label><input type="text"  id="agent_name"  name="agent_name['+ x +']"  class="form-control " required></div><div class="col-md-3"><label>Agent Email '+lc+'</label> <input type="email"  id="agent_email"  name="agent_email['+ x +']"  class="form-control " required ></div><div class="col-md-3"><label>Agent Password '+lc+'</label> <input type="password"  id="agent_password"  name="agent_password['+ x +']"  class="form-control " required ></div><button type="button" class="col-md-3 rounded-pill btn-block btn-danger remove_field">Delete</button></div>'); //add input box
    
                
            }
            else{
                alert('Please upgrade package for add more agent');
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>


@endsection
@push('js')
<script>
    $(document).ready(function() {
    
        var cid = @isset($info) {{$info->country}} @endif;
        var sid = @isset($info) {{$info->state}} @endif;
        var bcid = @isset($info) {{$info->billing_country}} @endif;
        var bsid = @isset($info) {{$info->billing_state}} @endif;
        getState(cid);
        getCity(sid);
        getBillingState(bcid);
        getBillingCity(bsid);
    });  

    $('#country').on('change', function(){
        var cid = $(this).val();
        getState(cid);
    });
    $('#state').on('change', function(){
        var sid = $(this).val();
        getCity(sid);
    });
    $('#billing_country').on('change', function(){
        var bcid = $(this).val();
        getBillingState(bcid);
    });
    $('#billing_state').on('change', function(){
        var bsid = $(this).val();
        getBillingCity(bsid);
    });
    function getState(cid){
        $.ajax({
            type:'GET',
            url:"{{url('get_state')}}",
            data:'country_id='+cid,
            success: function(response) {
                
                $('#state').html('');                   
                $.each(response.data,function (i, state){
                    // $('#state').addOption({value: state.id, text: staff.first_name+' '+ staff.last_name});
                    // console.log(state.name);
                    $('#state').append('<option value='+state.id+'>'+state.name+'</option>');
                    // if($('#state option').val() == @isset($info) {{$info->state}} @endif) {
                    //     $('#state option').prop("selected", true);
                    // }                   
                });
                $('#state option[value=@isset($info) {{$info->state}} @endif]').attr('selected','selected');
               
            }
        });
    }
    
    
    function getBillingState(bcid){
        $.ajax({
            type:'GET',
            url:"{{url('get_state')}}",
            data:'country_id='+bcid,
            success: function(response) {
                
                $('#billing_state').html('');                   
                $.each(response.data,function (i, state){
                    // $('#state').addOption({value: state.id, text: staff.first_name+' '+ staff.last_name});
                    // console.log(state.name);
                    $('#billing_state').append('<option value='+state.id+'>'+state.name+'</option>');
                    // if($('#billing_state option').val() == @isset($info) {{$info->billing_state}} @endif) {
                    //     $('#billing_state option').prop("selected", true);
                    // }                      
                });
                $('#billing_state option[value=@isset($info) {{$info->billing_state}} @endif]').attr('selected','selected');
               
            }
        });
    }
    
    function getCity(sid){
    
        $.ajax({
            type:'GET',
            url:"{{url('get_city')}}",
            data:'state_id='+sid,
            success: function(response) {
                $('#city').html('');
                $.each(response.data,function (i, city){
                    // $('#state').addOption({value: state.id, text: staff.first_name+' '+ staff.last_name});
                    // console.log(city.name);
                    $('#city').append('<option value='+city.id+'>'+city.name+'</option>'); 
                });
                // if($('#city option').val() == @isset($info) {{$info->city}} @endif) {
                //     $('#city option').prop("selected", true);
                // }
                $('#city option[value=@isset($info) {{$info->city}} @endif]').attr('selected','selected');                     
               
                
            }
        });
    }
    function getBillingCity(bsid){
    
        $.ajax({
            type:'GET',
            url:"{{url('get_city')}}",
            data:'state_id='+bsid,
            success: function(response) {
                $('#billing_city').html('');
                $.each(response.data,function (i, city){
                    // $('#state').addOption({value: state.id, text: staff.first_name+' '+ staff.last_name});
                    // console.log(city.name);
                    $('#billing_city').append('<option value='+city.id+'>'+city.name+'</option>');       
                                
                });
                $('#billing_city option[value=@isset($info) {{$info->billing_city}} @endif]').attr('selected','selected');
               
                
            }
        });
    }
         
   
</script>
@endpush