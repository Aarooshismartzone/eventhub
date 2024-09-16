<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\CompanyDetail;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Hash;  
use Route;
use Mail; 
use File;
// use Session;
use Response;
use Carbon\Carbon;
use Stripe;

use Stripe\Checkout\Session;
use Stripe\Customer;
use Illuminate\Support\Facades\Log;
// use telesign\sdk\messaging\MessagingClient;

// require __DIR__ . "/../vendor/autoload.php";

class PaymentController extends Controller {

	public function stripe(Request $request)
    {
		$amount=35.99;
		// $amount=$request->amount;
        return view('payment',compact('amount'));
    }


	
    // public function stripePost(Request $request)
	// {
		
	// 	// dd($request->all());
	// 	// require 'vendor/autoload.php';
	// 	// $stripe = new \Stripe\StripeClient('sk_test_tR3PYbcVNZZ796tH88S4VQ2u');
		
	// 	// $create=$stripe->paymentIntents->create([
	// 	// 	'amount' => 35.99,
	// 	// 	'currency' => 'usd',
	// 	// 	"source" => $request->stripeToken,
	// 	// 	'automatic_payment_methods' => ['enabled' => true],
	// 	// ]);
	// 	dd($stripe,$create);
	// 	// $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
		

	// 	//   $response=Stripe\Charge::create ([
	// 		// 		"amount" => $request->amount*1,
	// 		// 		"currency" => "usd",
	// 		// 		"source" => $request->stripeToken,
	// 		// 		"description" => "This payment is testing purpose of techsolutionstuff",
	// 		//     ]);


	// 	$checkout_session = $stripe->checkout->sessions->create([
	// 		'line_items' => [[
	// 			'price_data' => [
	// 				'currency' => 'usd',
	// 				'product_data' => [
	// 					'name' => 'T-shirt',
	// 				],
	// 				'unit_amount' => 2000,
	// 			],
	// 			'quantity' => 1,
	// 			]],
	// 			'mode' => 'payment',
	// 			'success_url' => 'http://localhost:4242/success',
	// 			'cancel_url' => 'http://localhost:4242/cancel',
	// 		]);
	// 		// dd($checkout_session);

	// 		header("HTTP/1.1 303 See Other");
	// 		header("Location: " . $checkout_session->url);

			
		

	// }
	

	
    public function stripePost(Request $request)
    {
		Log::debug($request->all());
        $setapi=Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
		Log::debug($setapi);
        $response=Stripe\Charge::create ([
			"amount" => 35*11,
			"currency" => "usd",
			"source" => $request->stripeToken,
			"description" => "This payment is testing purpose of techsolutionstuff",
        ]);
		
		Log::debug($response);
		// dd($response);
   		//dd($response,true);
        // Session::flash('success', 'Payment Successfull!');
		if($response['status'] == 'succeeded') {
        	return redirect()->back()->withSuccess('Payment Successfull!');
		}
		else{
			return redirect()->back()->withError('Something was wrong!');
		}
    }
	
}