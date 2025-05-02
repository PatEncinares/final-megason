<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['patient_id','doctor_id','schedule_id','doctor_fee','total_amount','status','lab_fee','discount'];

    public function procedures(){
        return $this->belongsToMany('App\Procedure');
    }

    public function patient(){
        return $this->belongsTo('App\User','patient_id');
    }

    public function doctor(){
        return $this->belongsTo('App\User','doctor_id');
    }

    public function appointment(){
        return $this->belongsTo('App\Appointment','schedule_id');
    }
}
