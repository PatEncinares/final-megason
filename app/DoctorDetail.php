<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorDetail extends Model
{
    protected $fillable = ['user_id','fullname','gender','specialization','address'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    

}
