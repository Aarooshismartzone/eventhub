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

class HomeController extends Controller {

    
    public function eventPage($company,$slug){
        
        $event=Event::where('page_slug',$slug)->first();
        // dd($slug,$event);
        $images=DB::table('event_images')->where('event_id',$event->id)->orderBy('id','DESC')->take(4)->get();
        return view('hotelpage',compact('event','images'));
    
    }

    public function getCountry(Request $request){
        $query=DB::table('countries')->orderBy('name','ASC');

        if($request->country_id){
            if($request->country_id!=''){
                $query->where('id',$request->country_id);
            }
        }
        $countries=$query->get();
        return response()->json(['status' => false, 'msg'=>'Country','data'=>$countries]);
    }
    public function getState(Request $request){
        // dd($request->all());
        $query=DB::table('states')->orderBy('name','ASC');

        if($request->country_id){
            if($request->country_id!=''){
                $query->where('country_id',$request->country_id);
            }
        }
        if($request->state_id){
            if($request->state_id!=''){
                $query->where('id',$request->state_id);
            }
        }
        $states=$query->get();
        return response()->json(['status' => false, 'msg'=>'State','data'=>$states]);
    }
    public function getCity(Request $request){
        $query=DB::table('cities')->orderBy('name','ASC');

        if($request->country_id){
            if($request->country_id!=''){
                $query->where('country_id',$request->country_id);
            }
        }
        if($request->state_id){
            if($request->state_id!=''){
                $query->where('state_id',$request->state_id);
            }
        }
        if($request->city_id){
            if($request->city_id!=''){
                $query->where('id',$request->state_id);
            }
        }
        $cities=$query->get();
        return response()->json(['status' => false, 'msg'=>'City','data'=>$cities]);
    }
}