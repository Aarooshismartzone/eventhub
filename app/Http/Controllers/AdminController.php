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


class AdminController extends Controller {

	
	
	public function login(Request $request) {
		
		// dd($request->all());
			$request->validate([
				'email' => 'required|email',
				'password' => 'required|min:8',
				
			]);
			
			if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'user_type'=>'admin']))
			{
				return redirect('/admin');				
			}else{			
				
				return redirect()->back()->withError('wrong credentials');	
			}
					

	}
	
	public function logout(Request $request) {
		Auth::logout();
		return redirect('admin/login');
	}
	
	public function dashboard(Request $request) {
		// if(auth()->user()->companyInfo()){
		// 	$info=auth()->user()->companyInfo();
		// 	 $agents=User::where('parent_id',auth()->user()->id)->get();
		// 	 return view('company/dashboard',compact('info','agents'));
		//  }
		 return view('admin/dashboard');
	}
	public function companies(Request $request) {
		$companies=User::where([['user_type','company'],['otp_verified',1]])->get();
		//dd($companies);
		 return view('admin/companies',compact('companies'));
	}
	public function events(Request $request) {
		$query=Event::where('status',1)->orderBy('id',"DESC");
		if($request->event_type){
			if($request->event_type!=''){
				$query->where('event_type',$request->event_type);
			
			}
		}
		if($request->date_from && $request->date_to){
			if($request->date_from!='' && $request->date_to!=''){
				$query->whereBetween('event_date_from',[$request->date_from,$request->date_to]);
				// $query->whereDate('event_date_from','>=',$request->date_from)->whereDate('event_date_to','<=',$request->date_to);
			
			}
		}
		$events=$query->get();
		
		 return view('admin/events',compact('events'));
	}
	public function users(Request $request) {
		$bookings=DB::table('bookings')->get();
		 return view('admin/users',compact('bookings'));
	}

	


}