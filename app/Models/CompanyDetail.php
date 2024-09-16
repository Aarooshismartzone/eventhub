<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

            'company_id','account_holder_name','email','mobile','company_name','job_title','service_offered','vat','company_address','country','city','state','zipcode','same_address','billing_address','billing_country','billing_city','billing_state','billing_zipcode'
    ];

    public function user(){
        return $this->belongsTo(User::class,'company_id');
    }
    
    public function maxEvent(){
        return Event::where('company_id',$this->company_id)->max('id');
    }
   
 
}
