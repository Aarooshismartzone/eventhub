<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'event_date_from','event_date_to','single_occupancy', 'double_occupancy', 'page_slug','company_id','event_name','event_type',
        'event_date','event_time_from','event_time_to', 'event_about', 'event_map_city', 'event_map_address','address1','address2', 'state','country','zipcode','map','max_no_of_guest','hotel_name','no_of_available_room','deposit_last_date','deposit_amount','canc_waiver',	'page_title','page_about','page_slug','logo','feature_image','status'	
    ];

    public function companyInfo(){
         return $this->hasOne(CompanyDetail::class, 'company_id', 'company_id');
       //return $this->belongesTo(CompanyDetail::class,'company_id','company_id');
     }
    public function companyLegalName(){
        return CompanyDetail::where('company_id',$this->company_id)->pluck('company_name')->first();
        // return $this->belongesTo(User::class,'company_id');
    }
   
 
}
