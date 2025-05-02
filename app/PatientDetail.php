<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class PatientDetail extends Model
{
    protected $fillable = ['user_id','doctor_id','mobile_number','gender','civil_status','age','fullname','address','email','date_of_birth','emergency_name','emergency_number','emergency_address','weight','height'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function doctor(){
        return $this->belongsTo('App\User','doctor_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class,'user_id','user_id')->orderBy('id','desc');
    }
}
