<div class="row">
    <div class="col-sm-8 pe-4">
        <hr class="mt-5">
        <div class="card titlehead" style="margin-top: -30px; max-width: 200px">Billing Information</div>
        <div class="ms-2">
            <div class="lbl mt-3" style="font-weight: 800; color: black">{{$user->companyInfo()->account_holder_name}}</div>
            <p class="lbl">{{$user->companyInfo()->company_name}}</p>
            <div class="mt-4">
                <table style="border: none" class="lbl">
                    <tr>
                        <td style="width: 100px">Email:</td>
                        <td>{{$user->companyInfo()->email}}</td>
                    </tr>
                    <tr>
                        <td style="width: 100px">Mobile:</td>
                        <td>{{$user->companyInfo()->mobile}}</td>
                    </tr>
                </table>
            </div>
            <div class="mt-4 lbl">
            {{$user->companyInfo()->billing_address}}, <br>
            {{$user->companyInfo()->billing_city}}, {{$user->companyInfo()->billing_state}}, <br>
            {{$user->companyInfo()->country}}
            </div>
            <a href="#" class="btn editbtn mt-3">Edit</a>
        </div>
        <!-- payment details -->
        <hr class="mt-5">
        <div class="card titlehead" style="margin-top: -30px; max-width: 200px">Billing Information</div>
        <div class="ms-2">
            <div class="lbl mt-3" style="font-weight: 800; color: black">Amanda Ritwik</div>
            <img src="{{asset('images/icons/visa.png')}}" style="width: 30px">
            <span class="lbl">**** **** **** 0569</span>
            <div class="lbl mt-2">Expires 11/28</div>
            <a href="#" class="btn editbtn mt-3">Change Payment Method</a>
        </div>
        <!-- Billing History -->
        <hr class="mt-5">
        <div class="card titlehead" style="margin-top: -30px; max-width: 200px">Billing History</div>
        <div class="ms-2">
            <table class="table mt-3 lbl">
                <tbody>
                    <tr>
                        <th scope="col">Invoice Details</th>
                        <th scope="col">Amount</th>
                        <th scope="col"></th>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">LGT 58546622</a>
                            <div class="mt-2">Standard Plan</div>
                            <div class="minitext">Mon, Nov 06, 2023 08:43 PM</div>
                        </td>
                        <td>1220</td>
                        <td><a href="#" class="btn editbtn">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">LGT 58546622</a>
                            <div class="mt-2">Standard Plan</div>
                            <div class="minitext">Mon, Nov 06, 2023 08:43 PM</div>
                        </td>
                        <td>1220</td>
                        <td><a href="#" class="btn editbtn">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">LGT 58546622</a>
                            <div class="mt-2">Standard Plan</div>
                            <div class="minitext">Mon, Nov 06, 2023 08:43 PM</div>
                        </td>
                        <td>1220</td>
                        <td><a href="#" class="btn editbtn">View</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end of left column -->

    <!-- right column     -->
    <div class="col-sm-4 mt-3">
        <div class="card">
            <div class="greypart">
                <div class="lbl" style="font-weight: 800; color: black">{{$subs->exp_date}}</div>
                <h3 style="color: orangered; font-weight: 800; font-family: 'montserrat', sans-serif;">{{round($subs->amount,2)}}$</h3>
            </div>
            <div class="whitepart">
                <nav style="display: flex; justify-content: space-between">
                    <div class="lbl">Standard Plan</div>
                    <div class="lbl">${{round($subs->amount,2)}}<br><div class="minitext">Per Month
                    </div></div>
                </nav>
                <nav style="display: flex; justify-content: space-between">
                    <div class="lbl">Tax</div>
                    <div class="lbl">$0</div>
                </nav>
                <hr class="mt-3 mb-3">
                <nav style="display: flex; justify-content: space-between">
                    <div style="font-weight: 800; color: #07269B">Total</div>
                    <div style="font-weight: 800; color: #07269B">${{round($subs->amount,2)}}</div>
                </nav>
            </div>
        </div>
    </div>
</div>