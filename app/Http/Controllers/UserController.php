<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\CompanyDetail;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;
use Hash;
use Route;
use Mail; 
use File;
use Session;
use Carbon\Carbon;


class UserController extends Controller {

	public function registration(Request $request) {
			$request->validate([
				'fname' => 'required|string',
				'lname' => 'required|string',
				'email' => 'required|email|unique:users',
				'password' => 'required|min:8|regex:((?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,})',
				'confirm_password' => 'required|min:8',
			]);
			Session::flush();
			if($request->password!=$request->confirm_password){
			
				return redirect()->back()->withError('Password and confirm password did not matched')->withInput();
			}
			$data=User::create([
			'first_name'=>$request->fname,
			'last_name'=>$request->lname,
			'email'=>$request->email,
			'company_legal_name'=>$request->company_legal_name,
			'password'=>Hash::make($request->password),
			'user_type'=>'user'
			]);
			if($data){
			Session::put('user',$data);
				return redirect('user/getotp');
			}
		return redirect()->back()->withInput();
		

	}
	
	public function getotp(Request $request) {
		$user=Session::get('user');
			$request->validate([
				'phone' => 'required|numeric',
				
			]);

			$countrycode=$request->countrycode;
			$phone=$request->phone;
			$to=$countrycode.''.$phone;
			$otp=987654;
			// $otp=rand(111111,999999);
			$body='OTP for your User registration is :'.$otp;

			$user->phone=$request->phone;		
			$user->otp=$otp;		
			$user->save();		
			
			// Session::put('mobile',$request->phone);
			// $curl = curl_init();

			// curl_setopt_array($curl, array(
			// CURLOPT_URL => 'https://api.twilio.com/2010-04-01/Accounts/AC210d5054cfcf7f9f79ed0d14c348b810/Messages.json',
			// CURLOPT_RETURNTRANSFER => true,
			// CURLOPT_ENCODING => '',
			// CURLOPT_MAXREDIRS => 10,
			// CURLOPT_TIMEOUT => 0,
			// CURLOPT_FOLLOWLOCATION => true,
			// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			// CURLOPT_CUSTOMREQUEST => 'POST',
			// CURLOPT_POSTFIELDS => "Body=$body&From=%2B18883025913&To=$to",
			// CURLOPT_HTTPHEADER => array(
			// 	'Content-Type: application/x-www-form-urlencoded',
			// 	'Authorization: Basic QUMyMTBkNTA1NGNmY2Y3ZjlmNzllZDBkMTRjMzQ4YjgxMDphYmE3ZDU5MGJmOWYwZGZmYTkyZjc1MjU2ODlkMTYzYQ=='
			// ),
			// ));

			// $response = curl_exec($curl);

			// curl_close($curl);
			// //echo $response;
			// $response=json_decode($response);
			
			// // dd($response,$response->status);


			// if($response->status=='queued'){
			if($user->save()){
				
				return redirect('user/setotp');
			}
		return redirect()->back()->withInput();		

	}
	public function setotp(Request $request) {
		$user=Session::get('user');
		
			$request->validate([
				'otp' => 'required|numeric|min:6',
				
			]);
			$data=User::where([['id',$user->id],['otp',$request->otp]])->first();
			
			if($data){
				$data->otp_verified=1;
			$data->save();
				Session::flush();
				return redirect('user/login')->withSuccess('Your account is created successfully, please <b>sign in</b> to continue.');
			}else{
				
				return redirect()->back()->withError('invalid Otp');	
			}		

	}
	
	public function login(Request $request) {
		
		// dd($request->all());
			$request->validate([
				'email' => 'required|email',
				'password' => 'required|min:8',
				
			]);
			
			if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'user_type'=>'user']))
			{
				return redirect('/user');				
			}else{			
				
				return redirect()->back()->withError('wrong credentials');	
			}
					

	}
	
	public function logout(Request $request) {
		Auth::logout();
		return redirect('user/login');
	}
	
	public function dashboard(Request $request) {
		// if(auth()->user()->companyInfo()){
		// 	$info=auth()->user()->companyInfo();
		// 	 $agents=User::where('parent_id',auth()->user()->id)->get();
		// 	 return view('company/dashboard',compact('info','agents'));
		//  }
		 return view('user/dashboard');
	}

	public function eventlist(Request $request){
		$countries=DB::table('countries')->orderBy('name','ASC')->get();
		$query=Event::where('status',1)->orderBy('id','DESC');

		if($request->event_type){
			if($request->event_type!=''){
				$query->where('event_type',$request->event_type);
			
			}
		}
		if($request->date_from && $request->date_to){
			if($request->date_from!='' && $request->date_to!=''){
				$query->whereBetween('event_date_from',[date('Y-m-d',strtotime($request->date_from)),date('Y-m-d',strtotime($request->date_to))]);
				// $query->whereDate('event_date_from','>=',$request->date_from)->whereDate('event_date_to','<=',$request->date_to);
			
			}
		}
		
		$events=$query->get();
	
		return view('company/events/list',compact('events','countries'));
	}
	
	public function eventBookingPage($id){
		$countries=DB::table('countries')->orderBy('name','ASC')->get();
		
        return view('user/events/eventpostlogin', compact('id','countries'));
	}

	public function contactInfo(Request $request){
		$validator=Validator::make($request->all(),[
            'event_id' => 'required|numeric',
			"name" => 'required|string',
			"email" => 'required|email',
			"mobile" =>'required|numeric|digits_between:10,12', 
			"got_to_know" => 'required|string',
			"address" => 'required|string',
			"app" => 'required|string',
			"city" =>'required|string', 
			"country" =>'required|string',
			"state" => 'required|string',
			"zipcode" => 'required|numeric|digits_between:6,6',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => 'Please fill the required fields', 'errors'=>$validator->errors()]);
            }

		$user=auth()->user();
			$booking=DB::table('bookings')->insertGetId([				
				"user_id" => $user->id,
				"event_id" => $request->event_id,
				"name" => $request->name,
				"email" => $request->email,
				"mobile" =>$request->mobile, 
				"got_to_know" => $request->got_to_know,
				"address" => $request->address,
				"app" => $request->app,
				"city" =>$request->city, 
				"country" => $request->country,
				"state" => $request->state,
				"zipcode" => $request->zipcode,
			]);
			
			if($booking)
            {
                // return $msg='ok';
                return response()->json(['status' => true, 'msg'=>'Contact Info and Addressed Saved Successfully.','bookingId'=>$booking]);
            }
            else
            {
                // return $msg='Something was wrong!';
                return response()->json(['status' => false, 'msg'=>'*Something was wrong!']);
            }
	}
	public function roomInfo(Request $request){
		//  dd($request->all());
		$validator=Validator::make($request->all(),[
			'booking_id' => 'required|numeric', 
			"is_ext" => 'required|in:yes,no',
			"leave_date" => 'required_if:is_ext,yes',
			"return_date" => 'required_if:is_ext,yes && after:leave_date',
			"is_share_room" =>'required|in:yes,no',
			"share_booking_code" => 'required_if:is_share_room,yes',			
			"single_occupancy" => 'required|numeric',
			"double_occupancy" => 'required|numeric',
        ],[
			'share_booking_code.required_if'=>'Booking code field is required when sharing room.',
			'leave_date.required_if'=>'Leave Date is required for Extension.',
			'return_date.required_if'=>'Return Date is required for Extension.',
		]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => 'Please fill the required fields', 'errors'=>$validator->errors()]);
            }

		$user=auth()->user();
		// $event=Event::where('id',$request->booking_id)->first();
		$booking=DB::table('bookings')->where('id',$request->booking_id)->update([				
				"is_ext" => $request->is_ext,
				"leave_date" => date('Y-m-d',strtotime($request->leave_date)),
				"return_date" => date('Y-m-d',strtotime($request->return_date)),
				"is_share_room" =>$request->is_share_room,
				"share_booking_code" => $request->share_booking_code,
				"single_occupancy" => $request->single_occupancy,
				"double_occupancy" => $request->double_occupancy,
			]);
			
			return response()->json(['status' => true, 'msg'=>'Room Details Saved Successfully.','bookingId'=>$request->booking_id]);
            
	}
	public function packageInfo(Request $request){
		$validator=Validator::make($request->all(),[
            'booking_id' => 'required|numeric',
            'package_id' => 'required|numeric',
			
        ],[
			'package_id.required'=>'select package'
		]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => 'Please fill the required fields', 'errors'=>$validator->errors()]);
            }
		$user=auth()->user();
		// $event=Event::where('id',$request->booking_id)->first();
		$booking=DB::table('bookings')->where('id',$request->booking_id)->update([				
				"package_id" => $request->package_id,
			]);
			if($booking)
            {
               return response()->json(['status' => true, 'msg'=>'Package Details Saved Successfully.','bookingId'=>$request->booking_id]);
            }
            else
            {
                return response()->json(['status' => false, 'msg'=>'*Something was wrong!']);
            }
	}
	public function travelerInfo(Request $request){

		$validator=Validator::make($request->all(),[
            'booking_id' => 'required|numeric',
            "for_whom" =>'required|string',
			"is_canc_waiver" => 'required|string',
			"comments" => 'required|string',
			"guest_type" => 'required|array',
			
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => 'Please fill the required fields', 'errors'=>$validator->errors()]);
            }

		$user=auth()->user();
		DB::table('traveler_details')->where('booking_id',$request->booking_id)->delete();
				// $event=Event::where('id',$request->booking_id)->first();
			DB::table('bookings')->where('id',$request->booking_id)->update([				
				"for_whom" => $request->for_whom,
				"is_canc_waiver" => $request->is_canc_waiver,
				"comments" => $request->comments,
			]);

			for($g=0; $g<count($request->guest_type); $g++){

				DB::table('traveler_details')->insert([
					"booking_id" => $request->booking_id,
					"guest_type" => $request->guest_type[$g],
					"guest_name" => $request->guest_name[$g],
					"guest_dob" =>date('Y-m-d',strtotime($request->guest_dob[$g])),
				]);		
	
			}
			return response()->json(['status' => true, 'msg'=>'Traveler Details Saved Successfully.','bookingId'=>$request->booking_id]);
           
	}
	public function policyInfo(Request $request){
		$validator=Validator::make($request->all(),[
            'booking_id' => 'required|numeric',
            "info_tick" =>'required|in:on',
			"terms_tick" => 'required|in:on',
			"payment_tick" => 'required|in:on',
			
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => 'Please fill the required fields', 'errors'=>$validator->errors()]);
            }

		$user=auth()->user();
		$booking_number=Str::random(30);
		$data=$this->paymentCalculation($request->booking_id);
		
			DB::table('bookings')->where('id',$request->booking_id)->update([				
				"info_tick" => $request->info_tick,
				"terms_tick" => $request->terms_tick,
				"payment_tick" => $request->payment_tick,
				"booking_number" => $booking_number,
				'payble_amount'=>$data['full_payment'],
			]);


			return response()->json(['status' => true, 'msg'=>'Policies  Saved Successfully.','data'=>$data]);
           
	}
	public function paymentCalculation($booking_id){		
		
		$bookingDetails=DB::table('bookings')->where('id',$booking_id)->first();
		
		$package=DB::table('event_packages')->where('id',$bookingDetails->package_id)->first(); //package details
		$event=DB::table('events')->where('id',$bookingDetails->event_id)->first(); //package details
		//Price per day  calculation

		$event_from_date = Carbon::parse($event->event_date_from);
		$event_to_date = Carbon::parse($event->event_date_to);
		$difference = $event_from_date->diffInDays($event_to_date);

		
		$now = Carbon::now();
		
		$event_countdown_days=$event_from_date->diffInDays($now);
		//dd($event_from_date,$now,$event_countdown_days);
		$total_adult=DB::table('traveler_details')->where([['booking_id',$booking_id],['guest_type','adult']])->count();
		$total_child=DB::table('traveler_details')->where([['booking_id',$booking_id],['guest_type','child']])->count();		
		$total_teen=DB::table('traveler_details')->where([['booking_id',$booking_id],['guest_type','teen']])->count();

		$adult_price=$package->price_per_adult * $total_adult;
		$child_price=$package->price_per_child * $total_child;
		$teen_price=$package->price_per_teenager * $total_teen;
		$total_price=(($adult_price + $child_price +$teen_price)*($difference+1));

		//end per day calculation


		if($bookingDetails->is_ext=='yes'){
			$leave_date = new Carbon($bookingDetails->leave_date);
			$return_date = new Carbon($bookingDetails->return_date);
			$difference = $leave_date->diffInDays($return_date);	
			
			//price for extend

			$adult_price=$package->price_per_adult_extended * $total_adult;
			$child_price=$package->price_per_child_extended * $total_child;
			$teen_price=$package->price_per_teenager_extended * $total_teen;
			$total_price=(($adult_price + $child_price +$teen_price) * ($difference+1));
			
		}
		$payable_amount=$total_price;
		if($bookingDetails->is_canc_waiver=='yes'){
			$payable_amount=$total_price + $event->canc_waiver;
		}

		$full_payment=$payable_amount;


  		$response=[
			'bookingId'=>$booking_id,
			'full_payment'=>$full_payment,
			'minimum_payment'=>$event->deposit_amount,
			//'installmentDiv'=>$installmentDiv,
			'event_countdown_days'=>$event_countdown_days,
		];
		return $response;

	}	
	
	public function paymentInfo(Request $request){
		// dd($request->all());
		$user=auth()->user();
		$txn_id=Str::random(30);
		if($request->payment_type=="full"){
			$amount=$request->full_payment;
		}else if($request->payment_type=="installment"){
			$amount=$request->minimum_payment;
		}
					
			DB::table('bookings')->where('id',$request->booking_id)->update([
				'payment_type'=>$request->payment_type,				
				'amount'=>$amount,
			]);
			// DB::table('payments')->insert([
			// 	'user_id'=>$user->id,
			// 	'event_id'=>$request->event_id,
			// 	'booking_id'=>$request->booking_id,
			// 	'txn_id'=>$txn_id,
			// 	'payment_type'=>$request->payment_type,
			// 	'full_payment'=>$request->full_payment,
			// 	'minimum_payment'=>$minimum_payment,
			// 	'status'=>0
			// ]);
		// dd($request->all());
		return redirect('/stripe');

	}

	/*
	public function booking(Request $request){
		// dd($request->all());
		$user=auth()->user();
			$contact=DB::table('bookings')->insertGetId([				
				"user_id" => $user->id,
				"event_id" => $request->event_id,
				"name" => $request->name,
				"email" => $request->email,
				"mobile" =>$request->mobile, 
				"got_to_know" => $request->got_to_know,
				"address" => $request->address,
				"app" => $request->app,
				"city" =>$request->city, 
				"country" => $request->country,
				"state" => $request->state,
				"zipcode" => $request->zipcode,
				"is_ext" => $request->is_ext,
				"leave_date" => $request->leave_date,
				"return_date" => $request->return_date,
				"is_share_room" =>$request->is_share_room,
				"share_booking_code" => $request->share_booking_code,
				"booking_number" => rand(1111111,9999999),
				"single_occupancy" => $request->single_occupancy,
				"double_occupancy" => $request->double_occupancy,
				"no_of_room" => ($request->double_occupancy+$request->single_occupancy),
				"package_id" => $request->package_id,
				"for_whom" => $request->for_whom,
				"is_canc_waiver" => $request->is_canc_waiver,
				"comments" => $request->comments,
				"info_tick" => $request->info_tick,
				"terms_tick" => $request->terms_tick,
				"payment_tick" => $request->payment_tick				
			]);
			
		for($g=0; $g<count($request->guest_type); $g++){

			DB::table('traveler_details')->insert([
				"booking_id" => $contact,
				"guest_type" => $request->guest_type[$g],
				"guest_name" => $request->guest_name[$g],
				"guest_dob" =>$request->guest_dob[$g]
			]);		

		}

		$event_from_date = Carbon::parse($request->event_from_date);
		$event_to_date = Carbon::parse($request->event_to_date);
		$difference = $event_from_date->diffInDays($event_to_date);

		//Price per day  calculation

		$package=DB::table('event_packages')->where('id',$request->package_id)->first(); //package details
		$event=DB::table('events')->where('id',$request->event_id)->first(); //package details
		
		$now = Carbon::now();
		
		$event_countdown_days=$event_from_date->diffInDays($now);
		//dd($event_from_date,$now,$event_countdown_days);
		$total_adult=DB::table('traveler_details')->where([['booking_id',$contact],['guest_type','adult']])->count();
		$total_child=DB::table('traveler_details')->where([['booking_id',$contact],['guest_type','child']])->count();		
		$total_teen=DB::table('traveler_details')->where([['booking_id',$contact],['guest_type','teen']])->count();

		$adult_price=$package->price_per_adult * $total_adult;
		$child_price=$package->price_per_child * $total_child;
		$teen_price=$package->price_per_teenager * $total_teen;
		$total_price=(($adult_price + $child_price +$teen_price)*($difference+1));

		//end per day calculation

		if($request->is_ext=='yes'){
			$leave_date = new Carbon($request->leave_date);
			$return_date = new Carbon($request->return_date);
			$difference = $leave_date->diffInDays($return_date);	
			
			//price for extend

			$adult_price=$package->price_per_adult_extended * $total_adult;
			$child_price=$package->price_per_child_extended * $total_child;
			$teen_price=$package->price_per_teenager_extended * $total_teen;
			$total_price=(($adult_price + $child_price +$teen_price) * ($difference+1));
			
		}
		$payable_amount=$total_price;
		if($request->is_canc_waiver=='yes'){
			$payable_amount=$total_price + $event->canc_waiver;
		}

		$full_payment=$payable_amount;

  		$response=[
			'bookingId'=>$contact,
			'full_payment'=>$full_payment,
			'minimum_payment'=>$event->deposit_amount,
			//'installmentDiv'=>$installmentDiv,
			'event_countdown_days'=>$event_countdown_days,
		];

		return $response;	
	}
	*/


}