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
use Session;
use Response;
use Carbon\Carbon;

// use telesign\sdk\messaging\MessagingClient;

// require __DIR__ . "/../vendor/autoload.php";

class CompanyController extends Controller {

	public function registration(Request $request) {
		$request->validate([
			'fname' => 'required|string',
			'email' => 'required|email|unique:users',
			
		]);
		Session::flush();
		$data=User::create([
		'first_name'=>$request->fname,
		'last_name'=>$request->lname,
		'email'=>$request->email,
		'company_legal_name'=>$request->company_legal_name,
		'user_type'=>'company'
		]);
		if($data){
		Session::put('user',$data);
			return redirect('company/setpass');
		}
	return redirect()->back()->withInput();
	

	}
	public function setpass(Request $request) {
		
		$user=Session::get('user');
		$request->validate([
			'password' => 'required|min:8|regex:((?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,})',
			'confirm_password' => 'required|min:8',
			
			
		]);
		if($request->password!=$request->confirm_password){
		
			return redirect()->back()->withError('Password and confirm password did not matched')->withInput();
		}
		$data=User::where('id',$user->id)->update(['password'=>Hash::make($request->password)]);
		
		if($data){
			
			return redirect('company/getotp');
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
			$body='OTP for your company registration is :'.$otp;
			
			$user->phone=$request->phone;		
			$user->otp=$otp;		
			$user->save();		
			
			// Session::put('mobile',$request->phone);
			/*$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.twilio.com/2010-04-01/Accounts/AC210d5054cfcf7f9f79ed0d14c348b810/Messages.json',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => "Body=$body&From=%2B18883025913&To=$to",
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded',
				'Authorization: Basic QUMyMTBkNTA1NGNmY2Y3ZjlmNzllZDBkMTRjMzQ4YjgxMDphYmE3ZDU5MGJmOWYwZGZmYTkyZjc1MjU2ODlkMTYzYQ=='
			),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			//echo $response;
			$response=json_decode($response);
			
			// dd($response,$response->status);

			*/
			// if($response->status=='queued'){
			if($user->save()){
				
				return redirect('company/setotp');
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
			$exp_date = Carbon::now()->addDays(30);
		
				//$event_countdown_days=$event_from_date->diffInDays($now);
			DB::table('subscriptions')->insert(['company_id'=>$data->id,'amount'=>35.99,'exp_date'=>$exp_date]);
				Session::flush();
				return redirect('company/login')->withSuccess('Your account is created successfully, please <b>sign in</b> to continue.');
			}else{
				
				return redirect()->back()->withError('invalid Otp');	
			}		

	}

	public function login(Request $request) {
		
		//dd(1);
			$request->validate([
				'email' => 'required|email',
				'password' => 'required|min:8',
				
			]);
			
			if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'user_type'=>'company']))
			{
				return redirect('/company');				
			}else{				
				return redirect()->back()->withError('wrong credentials');	
			}
						

	}

	public function logout(Request $request) {
		Auth::logout();
		return redirect('company/login');
	}

	public function dashboard(Request $request) {
		// if(auth()->user()->companyInfo()){
		// 	$info=auth()->user()->companyInfo();
		// 	 $agents=User::where('parent_id',auth()->user()->id)->get();
		// 	 return view('company/dashboard',compact('info','agents'));
		//  }
		 return view('company/dashboard');
	}
	public function companyInfo(Request $request) {
		$subscription=DB::table('subscriptions')->where('company_id',auth()->user()->id)->first();
		$countries=DB::table('countries')->orderBy('name','ASC')->get();
		if(auth()->user()->companyInfo()){
			
			$info=auth()->user()->companyInfo();
			 $agents=User::where('parent_id',auth()->user()->id)->get();
			 return view('company/compinfo',compact('info','agents','subscription','countries'));
		 }
		 
		 return view('company/compinfo',compact('subscription','countries'));
	}
	public function companyInfoStore(Request $request) {
		
		$request->validate([
			'mobile' => 'required|numeric|digits_between:10,12',
			'email' => 'required|email',
			'account_holder_name'=>'required|string',
			'company_name'=>'required|string',
			'job_title'=>'required|string',
			'service_offered'=>'required|string',
			'vat'=>'required|numeric',
			'company_address'=>'required|string',
			'country'=>'required',
			'city'=>'required',
			'state'=>'required',
			'zipcode'=>'required|numeric|digits_between:6,6',
			// 'same_address'=>'required',		
		]);
		$same_address = 'no';
		$billing_address = $request->billing_address;
		$billing_country = $request->billing_country;
		$billing_city = $request->billing_city;
		$billing_state = $request->billing_state;
		$billing_zipcode = $request->billing_zipcode;
		if($request->same_address){
			if($request->same_address=='yes'){
				$same_address = 'yes';				
				$billing_address = $request->company_address;
				$billing_country = $request->country;
				$billing_city = $request->city;
				$billing_state = $request->state;
				$billing_zipcode = $request->zipcode;
			}
		}
		
		// DB::transaction(function (Request $request) {
			$user=auth()->user();

			$user->company_legal_name=$request->company_name;
			$user->save();

			if($request->agent_email && $request->agent_name){
				$agentemail=$request->agent_email;
				$agentname=$request->agent_name;
				$agentpass=$request->agent_password;

				for($i=0; $i < count($agentemail); $i++){
					
					USer::updateOrCreate([			
							'email'=>$agentemail[$i],
							'parent_id'=>$user->id],		
							['first_name'=>$agentname[$i],
							'password'=>Hash::make($agentpass[$i]),						
							'user_type'=>'agent'				
					]);
				}
	
			}
			
			
			$info=CompanyDetail::updateOrCreate([
				'company_id'=>$user->id],
				['account_holder_name'=>$request->account_holder_name,
				'email'=>$request->email,
				'mobile'=>$request->mobile,
				'company_name'=>$request->company_name,
				'job_title'=>$request->job_title,
				'service_offered'=>$request->service_offered,
				'vat'=>$request->vat,
				'same_address'=>$same_address,
				'company_address'=>$request->company_address,
				'country'=>$request->country,
				'city'=>$request->city,
				'state'=>$request->state,
				'zipcode'=>$request->zipcode,
				'billing_address'=>$billing_address,
				'billing_country'=>$billing_country,
				'billing_city'=>$billing_city,
				'billing_state'=>$billing_state,
				'billing_zipcode'=>$billing_zipcode,			
				
			]);

			
		// });
		if($info){
			// return redirect('/company');
			return redirect('/company/info')->withSuccess('Company Info Saved Successfully');
		}
		else{
		
		return redirect()->back()->withInput();
		}
		
	}



	public function eventList(Request $request) {
		$countries=DB::table('countries')->orderBy('name','ASC')->get();
		$query=Event::where([['company_id',auth()->user()->id],['status',1]])->orderBy('id','DESC');

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
		// dd($events);
		
		return view('company/events/list',compact('events','countries'));
	}
	public function addEvent(Request $request) {
		$countries=DB::table('countries')->orderBy('name','ASC')->get();
		return view('company/events/create',compact('countries'));
	}
	

	public function addEventDetails(Request $request) {
		$event_date=date('Y-m-d',strtotime($request->event_date_from));
			$event_date_from=date('Y-m-d',strtotime($request->event_date_from));
			$event_date_to=date('Y-m-d',strtotime($request->event_date_to));

		$validator=Validator::make($request->all(),[
            'event_name'=>'required|string',
			'event_type'=>'required|string',
			'event_date'=>'required_if:event_type,single && after:today',
			'event_time_from'=>'required_if:event_type,single && date_format:H:i',
			'event_time_to'=>'required_if:event_type,single && date_format:H:i && after:event_time_from',
			'event_date_from'=>'required_if:event_type,multiple && after:today',
			'event_date_to'=>'required_if:event_type,multiple && after:'.$event_date_from,
			'event_about'=>'required|string',			
			'event_map_address'=>'nullable|string',
			'address1'=>'nullable|string',
			'address2'=>'nullable|string',
			'state'=>'nullable|string',
			'country'=>'nullable|string',
			'zipcode'=>'nullable|numeric|digits_between:6,6',
			'max_no_of_guest'=>'required|numeric',
        ],[
			'event_date.after'=>'please select a future date for event',
			'event_date_from.after'=>'please select a future date for event',
		]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => 'Please fill the required fields', 'errors'=>$validator->errors()]);
            }
		// dd($request->all());
		$user=auth()->user();

			

		if($request->event_type=='single'){
			$event_date=date('Y-m-d',strtotime($request->event_date));
			$event_date_from=date('Y-m-d',strtotime($request->event_date));
			$event_date_to=date('Y-m-d',strtotime($request->event_date));
			
		}
		
			
		$event=Event::create([
			'company_id'=>$user->id,
			'event_name'=>$request->event_name,
			'event_type'=>$request->event_type,
			'event_date'=>$event_date,
			'event_time_from'=>$request->event_time_from,
			'event_time_to'=>$request->event_time_to,
			'event_date_from'=>$event_date_from,
			'event_date_to'=>$event_date_to,
			'event_about'=>$request->event_about,			
			'event_map_address'=>$request->event_map_address,
			'address1'=>$request->address1,
			'address2'=>$request->address2,
			'state'=>$request->state,
			'country'=>$request->country,
			'zipcode'=>$request->zipcode,
			'max_no_of_guest'=>$request->max_no_of_guest,

			
		]);
		if($event)
            {               
                return response()->json(['status' => true, 'msg'=>'Event Details Saved Successfully.','event'=>$event]);
            }
            else
            {                
                return response()->json(['status' => false, 'msg'=>'*Something was wrong!']);
            }


		
	}
	
	public function roomAndBooking(Request $request){

		
		$event=Event::where('id',$request->event_id)->first();
		$eventstart=$event->event_type=='single' ? $event->event_date : $event->event_date_from;
		// dd($eventstart);
		$eventstart = Carbon::parse($eventstart);
		$dep_last_dat_val=$eventstart->subDays(15);
		$validator=Validator::make($request->all(),[
			'event_id'=>'required|numeric',
			'hotel_name'=>'required|string',
			'single_occupancy'=>'required|numeric',
			'double_occupancy'=>'required|numeric',
			'deposit_amount'=>'required|numeric|gt:0',
			'deposit_last_date'=>'required|date|after:today|before:'.$dep_last_dat_val,
			'canc_waiver'=>'required|numeric|gt:0',
			'package_name'=>'required|array|min:1',
			'package_name.*'=>'required|string|distinct|min:3',
			
			
		],
		[
			'deposit_last_date.before'=>'Deposit last date must be before 15 days from Event date'
		]);
		if ($validator->fails()) {
			return response()->json(['status' => false, 'msg' => 'Please fill the required fields', 'errors'=>$validator->errors()]);
			}

		// dd($request->all());
	// $insertdata=DB::transaction(function($request, $event) {	
		DB::table('event_packages')->where('event_id',$event->id)->delete();
		$packages=$request->package_name;
	
				foreach($packages as $k=>$package){
					
					DB::table('event_packages')->insert([
						'event_id'=>$event->id,
						'package_name'=>$request->package_name[$k],
						'price_per_adult'=>$request->price_per_adult[$k],
						'price_per_adult_extended'=>$request->price_per_adult_extended[$k],
						'max_allowed_adult'=>$request->max_allowed_adult[$k],
						'price_per_teenager'=>$request->price_per_teenager[$k],
						'price_per_teenager_extended'=>$request->price_per_teenanger_extended[$k],
						'max_allowed_teenager'=>$request->max_allowed_teenager[$k],
						'price_per_child'=>$request->price_per_child[$k],
						'price_per_child_extended'=>$request->price_per_child_extended[$k],
						'max_allowed_child'=>$request->max_allowed_child[$k],
					
					]);
				}
				
				$event->hotel_name=$request->hotel_name;
				$event->single_occupancy=$request->single_occupancy;
				$event->double_occupancy=$request->double_occupancy;				
				$event->deposit_last_date=date('Y-m-d',strtotime($request->deposit_last_date));
				$event->deposit_amount=$request->deposit_amount;
				$event->canc_waiver=$request->canc_waiver;
				$event->save();
				
				
				
			// });
				if($event->save())
            {
                // return $msg='ok';
                return response()->json(['status' => true, 'msg'=>'Room And Booking Saved Successfully.','eventId'=>$event->id]);
            }
            else
            {
                // return $msg='Something was wrong!';
                return response()->json(['status' => false, 'msg'=>'*Something was wrong!']);
            }
	
				
			
	}


	 public function addEventPageDetails(Request $request)
	 {
		// dd($request->all());
		$event=Event::where('id',$request->event_id)->first();
		
		$validator=Validator::make($request->all(),[
			'event_id'=>'required|numeric',
			'page_title'=>'required|string|max:20',
			'page_slug'=>'required|string|max:20|unique:events',
			'page_about'=>'required|string',
			'logo'=>'required|mimes:jpg,jpeg,png|max:1048',
			'feature_image'=>'required|mimes:jpg,jpeg,png|max:1048',
			'images'=>'required|array',
			'images.*'=>'required|mimes:jpg,jpeg,png|max:1048',
		]);
		if ($validator->fails()) {
			return response()->json(['status' => false, 'msg' => 'Please fill the required fields', 'errors'=>$validator->errors()]);
			}
		// dd($request->all());
		DB::table('event_images')->where('event_id',$event->id)->delete();
		$images=count($request->images);

		for($i=0; $i < $images; $i++){
			$image_link = $request->file('images')[$i]->store('galary');
			DB::table('event_images')->insert([
			'event_id'=>$event->id,
			'image'=>$image_link,				
			]);
		}


			$logo_link ='';
			$feature_image ='';
			if($request->logo){
				$logo_link = $request->file('logo')->store('logo');
			}
			if($request->feature_image){
				$feature_image_link = $request->file('feature_image')->store('logo');
			}

			$event->page_title=$request->page_title;
			$event->page_slug=$request->page_slug;
			$event->page_about=$request->page_about;
			$event->logo=$logo_link;
			$event->feature_image=$feature_image_link;
			$event->status=1;
			$event->save();

			if($event->save())
            {
                // return $msg='ok';
                return response()->json(['status' => true, 'msg'=>'Page Details Saved Successfully.','eventId'=>$event->id]);
            }
            else
            {
                // return $msg='Something was wrong!';
                return response()->json(['status' => false, 'msg'=>'*Something was wrong!']);
            }

	}
	 public function eventPagePreview(Request $request)
	 {
		// dd($request->all());

		$event=Event::where('id',$request->event_id)->first();
		
		// $validator=Validator::make($request->all(),[
		// 	'event_id'=>'required|numeric',
		// 	'page_title'=>'required|string|max:20',
		// 	'page_slug'=>'required|string|max:20',
		// 	'page_about'=>'required|string',
		// 	'logo'=>'required|mimes:jpg,jpeg,png|max:1048',
		// 	'images'=>'required|array',
		// 	'images.*'=>'required|mimes:jpg,jpeg,png|max:1048',
		// ]);
		// if ($validator->fails()) {
		// 	return response()->json(['status' => false, 'msg' => 'Please fill the required fields', 'errors'=>$validator->errors()]);
		// 	}
		
		// 	DB::table('event_images')->where('event_id',$event->id)->delete();
		// $images=count($request->images);

		// for($i=0; $i < $images; $i++){
		// 	$image_link = $request->file('images')[$i]->store('galary');
		// 	DB::table('event_images')->insert([
		// 	'event_id'=>$event->id,
		// 	'image'=>$image_link,				
		// 	]);
		// }


		// 	$logo_link ='';
		// 	if($request->logo){
		// 		$logo_link = $request->file('logo')->store('logo');
		// 	}

		// 	$event->page_title=$request->page_title;
		// 	$event->page_slug=$request->page_slug;
		// 	$event->page_about=$request->page_about;
		// 	$event->logo=$logo_link;
		// 	$event->save();

			
		// 	if($event->save())
        //     {
        //        return response()->json(['status' => true, 'slug'=>$request->page_slug]);
        //     }
		$slug='/event/'.(strtolower(str_replace(' ','-',$event->companyLegalName()))).'/'.$event->page_slug;
               return response()->json(['status' => true, 'slug'=>$slug]);

	}


	 public function getEventDetails(Request $request){
		
		$event=Event::where('id',$request->eid)->first();
		$packages=DB::table('event_packages')->where('event_id',$event->id)->get();
		$images=DB::table('event_images')->where('event_id',$event->id)->get();
		$countries=DB::table('countries')->get();
		
		return response()->json(['status'=>true, 'countries'=>$countries,'images'=>$images,'event' => $event, 'packages'=>$packages]);
	 }

	

	public function bookingList(Request $request){
		
		
		$user=auth()->user();
		
		$myEvents=DB::table('events')->where('company_id',$user->id)->pluck('id')->toArray();
	
		$query=DB::table('bookings')->whereIn('event_id',$myEvents)->orderBy('id','DESC');


		// if($request->type){
		// 	if($request->type!=''){
		// 		$query->where('event_about',$request->type);
			
		// 	}
		// }
		// if($request->date){
		// 	if($request->date!=''){
		// 		$query->whereDate('event_date',$request->date);
			
		// 	}
		// }
		

		$bookings=$query->get();
		//dd($bookings);
		return view('company/users',compact('bookings'));		 
	}
	
	public function subscription(){
		$user=auth()->user();
		$agents=User::where('parent_id',auth()->user()->id)->get();
		$subs=DB::table('subscriptions')->where('company_id',$user->id)->first();
		return view('company/subscription',compact('user','subs','agents'));
	}

	public function agentDetails($id){
		$user=auth()->user();
		$agent=User::where([['parent_id',auth()->user()->id],['id',$id]])->first();
		
		return response()->json(['status' => true, 'agent'=>$agent]);
	}
	public function deleteAgent(Request $request){
		 //dd($request->all());
		$user=auth()->user();
		$agent=User::where([['parent_id',auth()->user()->id],['id',$request->agent_id]])->delete();
		// dd($agent);
		
		return response()->json(['status' => true, 'msg'=>'Agent Deleted Successfully']);
	}
	public function updateAgent(Request $request){
		// dd($request->all());
		$user=auth()->user();
		if($request->agent_password!=''){
			User::where([['parent_id',auth()->user()->id],['id',$request->agent_id]])->update(['first_name'=>$request->agent_name,'email'=>$request->agent_email,'password'=>Hash::make($request->agent_password)]);
		
			return response()->json(['status' => true, 'msg'=>'Agent Details Updated Successfully']);
		}
		else{
			User::where([['parent_id',auth()->user()->id],['id',$request->agent_id]])->update(['first_name'=>$request->agent_name,'email'=>$request->agent_email]);
		
			return response()->json(['status' => true, 'msg'=>'Agent Details Updated Successfully']);
		}
	}

	public function landingPage(Request $request){
		
		if($request->company){
			if($request->company!=''){
				$company_id=$request->company;
			}
		}
		else{
			$company_id=auth()->user()->id;
		}
        $events=Event::where('company_id',$company_id)->where('status',1)->get();
		 
        // $images=DB::table('event_images')->where('event_id',$event->id)->orderBy('id','DESC')->take(4)->get();
        
        return view('landingpage',compact('events'));
    
    }

	public function updateEvent(Request $request){

		$eventstart=$request->event_type=='single' ? $request->event_date : $request->event_date_from;
			// dd($eventstart);
			$eventstart = Carbon::parse($eventstart);
			$dep_last_dat_val=$eventstart->subDays(15);

		$validator=Validator::make($request->all(),[

			'event_id'=>'required|numeric',
			'event_name'=>'required|string',
			'event_type'=>'required|string',
			'event_date'=>'required_if:event_type,single && after:today',
			'event_time_from'=>'required_if:event_type,single && date_format:H:i',
			'event_time_to'=>'required_if:event_type,single && date_format:H:i && after:event_time_from',
			'event_date_from'=>'required_if:event_type,multiple && after:today',
			'event_date_to'=>'required_if:event_type,multiple && after:event_date_from',
			'event_about'=>'required|string',			
			'event_map_address'=>'nullable|string',
			'address1'=>'nullable|string',
			'address2'=>'nullable|string',
			'state'=>'nullable|string',
			'country'=>'nullable|string',
			'zipcode'=>'nullable|numeric|digits_between:6,6',
			'max_no_of_guest'=>'required|numeric',


			'hotel_name'=>'required|string',
			'single_occupancy'=>'required|numeric',
			'double_occupancy'=>'required|numeric',
			'deposit_amount'=>'required|numeric|gt:0',
			'deposit_last_date'=>'required|after:today|before:'.$dep_last_dat_val,
			'canc_waiver'=>'required|numeric|gt:0',
			'package_name'=>'required|array|min:1',
			'package_name.*'=>'required|string|min:3',

			
			'page_title'=>'required|string|max:20',
			'page_slug'=>'required|string|max:20|unique:events,page_slug,'.$request->event_id,
			'page_about'=>'required|string',
			'logo'=>'nullable|mimes:jpg,jpeg,png|max:1048',
			'feature_image'=>'nullable|mimes:jpg,jpeg,png|max:1048',
			'images'=>'nullable|array',
			'images.*'=>'nullable|mimes:jpg,jpeg,png|max:1048',
			
			
		],
		[
			'event_date.after'=>'please select a future date for event',
			'event_date_from.after'=>'please select a future date for event',
			'deposit_last_date.before'=>'Deposit last date must be before 15 days from Event date'
		]);	
		

		if ($validator->fails()) {
			return response()->json(['status' => false, 'msg' => 'Please fill the required fields', 'errors'=>$validator->errors()]);
		}
		
			$user=auth()->user();
			$event=Event::where('id',$request->event_id)->first();
			
	
			$event_date=date('Y-m-d',strtotime($request->event_date_from));
			$event_date_from=date('Y-m-d',strtotime($request->event_date_from));
			$event_date_to=date('Y-m-d',strtotime($request->event_date_to));
	
			if($request->event_type=='single'){
				$event_date=date('Y-m-d',strtotime($request->event_date));
				$event_date_from=date('Y-m-d',strtotime($request->event_date));
				$event_date_to=date('Y-m-d',strtotime($request->event_date));
				
			}
		if($request->package_name!=null){
			DB::table('event_packages')->where('event_id',$event->id)->delete();
			$packages=$request->package_name;
		
			foreach($packages as $k=>$package){
				
				DB::table('event_packages')->insert([
					'event_id'=>$event->id,
					'package_name'=>$request->package_name[$k],
					'price_per_adult'=>$request->price_per_adult[$k],
					'price_per_adult_extended'=>$request->price_per_adult_extended[$k],
					'max_allowed_adult'=>$request->max_allowed_adult[$k],
					'price_per_teenager'=>$request->price_per_teenager[$k],
					'price_per_teenager_extended'=>$request->price_per_teenanger_extended[$k],
					'max_allowed_teenager'=>$request->max_allowed_teenager[$k],
					'price_per_child'=>$request->price_per_child[$k],
					'price_per_child_extended'=>$request->price_per_child_extended[$k],
					'max_allowed_child'=>$request->max_allowed_child[$k],
				
				]);
			}
		}
		
	
	
		
			
			if($request->images!=''){
				DB::table('event_images')->where('event_id',$event->id)->delete();
				$images=count($request->images);

				for($i=0; $i < $images; $i++){
					$image_link = $request->file('images')[$i]->store('galary');
					DB::table('event_images')->insert([
					'event_id'=>$event->id,
					'image'=>$image_link,				
					]);
				}
			}
			
				
			
			$event->company_id=$user->id;
			$event->event_name=$request->event_name;
			$event->event_type=$request->event_type;
			$event->event_date=$event_date;
			$event->event_time_from=$request->event_time_from;
			$event->event_time_to=$request->event_time_to;
			$event->event_date_from=$event_date_from;
			$event->event_date_to=$event_date_to;
			$event->event_about=$request->event_about;		
			$event->event_map_address=$request->event_map_address;
			$event->address1=$request->address1;
			$event->address2=$request->address2;
			$event->state=$request->state;
			$event->country=$request->country;
			$event->zipcode=$request->zipcode;
			$event->max_no_of_guest=$request->max_no_of_guest;
	
			$event->hotel_name=$request->hotel_name;
			$event->single_occupancy=$request->single_occupancy;
			$event->double_occupancy=$request->double_occupancy;				
			$event->deposit_last_date=date('Y-m-d',strtotime($request->deposit_last_date));
			$event->deposit_amount=$request->deposit_amount;
			$event->canc_waiver=$request->canc_waiver;
			
			
			if($request->logo){
				$logo_link = $request->file('logo')->store('logo');
				$event->logo=$logo_link;
			}
			if($request->feature_image){
				$feature_image_link = $request->file('feature_image')->store('logo');
				$event->feature_image=$feature_image_link;
			}

			$event->page_title=$request->page_title;
			$event->page_slug=$request->page_slug;
			$event->page_about=$request->page_about;
			
			$event->save();
					
			
		
			if($event->save())
			{
				// return $msg='ok';
				return response()->json(['status' => true, 'msg'=>'Event Updated Successfully.','eventId'=>$event->id]);
			}
			else
			{
				// return $msg='Something was wrong!';
				return response()->json(['status' => false, 'msg'=>'*Something was wrong!']);
			}
	
		
	}
}