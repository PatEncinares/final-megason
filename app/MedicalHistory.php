<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    protected $table = 'medical_history';
    
    protected $fillable = ['patient_id','complains','diagnosis','treatment','last_visit','next_visit','attending_doctor'];

    public function patient(){
        return $this->belongsTo('App\User', 'patient_id');
    }

    public function doctor(){
        return $this->belongsTo('App\User', 'attending_doctor');
    }
}
