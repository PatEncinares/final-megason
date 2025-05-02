<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $fillable = ['employee_id','date','time','type'];

    public function employee(){
        return $this->belongsTo('App\Employee');
    }
}
