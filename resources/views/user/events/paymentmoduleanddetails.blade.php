<input type="hidden" value="" name="booking_id" id="booking_id4">
<h5 class="mt-3" style="font-weight: 800">Payment Module & Details</h5>
<div class="mt-4 mb-4">
    <div class="card titlehead">Payment Module</div>
</div>
<div class="width-adjust">
    <div class="card mt-3 orangecard">
        <nav style="display: flex; justify-content: space-between">
            <div class="row w-50">
                <div class="col-8">
                    <div class="lbl">Pay Full Payment</div>
                </div>
                <div class="col-4">
                    <h5 style="color: #07269B; font-weight: bold;" id="fullPaymentDiv">$0</h5>
                    
                </div>
            </div>
            <div>
                <input type="radio" class="btn-check" name="payment_type" value="full" id="option10" required>
                <label class="btn editbtn border-0 bcgt" for="option10" onclick="btnColorChgOne(this)">Select</label>
                <input type="hidden" name="full_payment" id="full_payment" value="">
            </div>
        </nav>
    </div>
    <div id="installmentDiv">
    <div class="card mt-3 orangecard">
        <nav style="display: flex; justify-content: space-between">
            <div class="row w-50">
                <div class="col-8">
                    <div class="lbl">Pay Minimum Payment</div>
                </div>
                <div class="col-4">
                    <h5 style="color: #07269B; font-weight: bold;">${{$event->deposit_amount}}</h5>
                </div>
            </div>
            <div>
                <input type="radio" class="btn-check" name="payment_type" value="installment" id="option11" required>
                <label class="btn editbtn border-0 bcgt" for="option11" onclick="btnColorChgOne(this)">Select</label>
                <input type="hidden" name="minimum_payment" id="minimum_payment" value="">
            </div>
        </nav>
        <div class="lbl" id="instDetails">
            Total Payment - $4500<br>
            Installments available - 9<br>
            Single Installment - $4500/9 = $500
        </div>
    </div>
    </div>
</div>
<div class="mt-4 mb-4">
    <div class="card titlehead">Payment Method</div>
</div>
<div class="width-adjust pe-5">
    <div class="row">
        <div class="col-sm-4 col-12 p-1">
            <div class="card amcard" style="background-color: #07269B; color: white; border-radius: 4px;">
                Credit or Debit Card
            </div>
        </div>
        <div class="col-sm-4 col-12 p-1">
            <div class="card amcard" style="border-radius: 4px;">
                Internet Banking
            </div>
        </div>
        <div class="col-sm-4 col-12 p-1">
            <div class="card amcard" style="border-radius: 4px;">
                Wallet/Other Payment
            </div>
        </div>
    </div>
    <div class="lbl mt-3" style="color: #3066BE;">Our Payment Partner is Stripe and PayPal, you will be redirected to the payment gateway page to complete 
        the payment.</div>
</div>
<div class="mt-4 mb-3">
    <button type="submit" class="btn bluebutton">Make Payment</button>
</div>
<script>
		function btnColorChgOne(sbb){
		$('.bcgt').addClass('editbtn');
		$('.bcgt').removeClass('greenbtn');
		$('.bcgt').html('Select');
		$(sbb).addClass('greenbtn');
		$(sbb).removeClass('editbtn');
		$(sbb).html('Selected');
	}
</script>