<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserType;
use App\DoctorDetail;
use App\PatientDetail;
use App\Employee;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','contact_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function usertype(){
        return $this->belongsTo('App\UserType','type');
    }

    public function doctorDetails(){
        return $this->hasOne('App\DoctorDetail','user_id');
    }

    public function patientDetails(){
        return $this->hasMany('App\PatientDetail','user_id');
    }

    public function employeeDetails(){
        return $this->hasOne('App\Employee','user_id');
    }


    public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }
}
