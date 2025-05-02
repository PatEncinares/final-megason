<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

class Payroll extends Model
{
    protected $table = "payroll";

    protected $fillable = ['employee_id','pay_period','total_hours_worked','total_days_worked','total_pay','employee_leave','ot','rholiday','sholiday','tmonth','bonus','gross_pay','sss','philhealth','pagibig','tax','total_deduction','net_pay'];

    public function employee(){
        return $this->belongsTo('App\Employee');
    }
}
