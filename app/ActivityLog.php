<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ActivityLog extends Model
{
    protected $table = 'activity_log';

    protected $fillable = ['user_id','activity'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
