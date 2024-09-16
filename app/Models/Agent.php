<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'company_id','name','email','password'	

    ];

    public function companyInfo(){
        return $this->belongsTo(CompanyDetail::class,'company_id');
    }
   
 
}
