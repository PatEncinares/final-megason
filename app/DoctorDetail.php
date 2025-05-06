<?php

namespace App;

use App\DoctorSchedule;
use Illuminate\Database\Eloquent\Model;

class DoctorDetail extends Model
{
    protected $fillable = ['user_id','fullname','gender','specialization','address'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function schedules()
{
    return $this->hasManyThrough(
        DoctorSchedule::class,
        User::class,
        'id',         // foreign key on User
        'doctor_id',  // foreign key on DoctorSchedule
        'user_id',    // local key on DoctorDetail
        'id'          // local key on User
    );
}
    

}
