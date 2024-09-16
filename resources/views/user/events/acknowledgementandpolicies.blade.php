<form method="post" enctype="multipart/form-data" id="policyInfo">
    @csrf
    <input type="hidden" value="" name="booking_id" id="booking_id3">
    <h5 class="mt-3" style="font-weight: 800">Acknowledgement & Policies</h5>
<div class="mt-4 mb-4">
    <div class="card titlehead" style="max-width: 200px;">Acknowledgement</div>
</div>
<div class="w-50">
    <div class="mt-3">
        <label class="ctr2">By ticking the checkbox, I acknowledge that the information presented
            in the form is both accurate and to the best of my knowledge.
            <input type="checkbox"  name="info_tick" required>
            <span class="checkmark"></span>
        </label>
    </div>
    <div class="mt-3">
        <label class="ctr2">I hereby consent to abide by the <a href="#">terms and conditions</a> outlined in the 
            T&C and <a href="#">Privacy Policy</a>.
            <input type="checkbox"  name="terms_tick" required>
            <span class="checkmark"></span>
        </label>
    </div>
    <div class="mt-3">
        <label class="ctr2">I hereby consent to abide by the <a href="#">non-refundable and non-transferrable</a> 
            outlined in the payment term documents.
            <input type="checkbox"  name="payment_tick" id="payment_tick"  required>
            <span class="checkmark"></span>
        </label>
    </div>
</div>
<div class="policyInfoStatusMsg"></div>
<div class="mt-4 mb-3">
    <button type="button" class="btn bluebutton" style="background-color: #3066BE;" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                aria-expanded="true" aria-controls="collapseFour">Back</button>
    <button type="submit" class="btn bluebutton ms-2" id="policyInfoBtn">Save & next</button>
</div>
</form>
<script>
$('#policyInfo').submit(function (stay) {
        $('.qerr').html('');
        $('.policyInfoStatusMsg').html('');
       
        var formdata=$(this).serialize();
        $.ajax({
                type: "POST",
                url: "{{url('/booking/policyInfo')}}",
                data:formdata,
                cache: true,
                success: function(response){
                    console.log(response.data);
                    if( response.status == false ) {
                                     
                        $.each(response.errors, function (errors_key, errors_val) {
                            console.log(errors_key,errors_val);
                            $('.error_'+errors_key).html(errors_val[0]).css("color","red","display","show");
                            $( errors_key ).text(errors_val[0]);
                        });
                        //$('.eventDetailsStatusMsg').html('<span style="color:red;">'+response.msg+'</p>');
                    }
                    if( response.status == true ) {
                        $('#policyInfoBtn').hide();
                        $('#booking_id4').val(response.data.bookingId);                        
                        $('.policyInfoStatusMsg').html('<div class="card successcard">'+response.msg+'</div>');
                        $("#cimg5").attr("src","{{asset('images/icons/grey-tick-icon-checked.png')}}");
                        if(response.data.event_countdown_days > 30)
                        {
                            $('#installmentDiv').show();
                            $('#instDetails').html("Total Payment - $"+response.data.full_payment+"<br>Installments available - $9<br>Single Installment - $"+(response.data.full_payment - response.data.minimum_payment)+"/9 = $"+((response.data.full_payment - response.data.minimum_payment)/9));
                        }else{
                            $('#installmentDiv').hide();
                        }
                        
                        $('#full_payment').val(response.data.full_payment);
                        $('#minimum_payment').val(response.data.minimum_payment);
                        
                        $('#fullPaymentDiv').html('$'+response.data.full_payment);
                    }                  
                    
                }

            });
            stay.preventDefault();
    });
</script>
<script>
    // function calculation(){
    //     var pack_id=$('#package_id').val();
    //     var is_canc_waiver=$('#is_canc_waiver').val();
    // }
</script>

