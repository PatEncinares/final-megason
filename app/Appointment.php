<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['doctor_id','user_id','date','time','real_time','status'];

    public function doctor(){
        return $this->belongsTo('App\User','doctor_id');
    }

    public function patient(){
        return $this->belongsTo('App\User','user_id');
    }

    public function user() // patient
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
