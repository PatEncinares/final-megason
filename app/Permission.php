<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserType;

class Permission extends Model
{
    protected $fillable = [
        'name','type_id'
    ];
    
    public function type(){
        return $this->belongsTo('App\UserType','type_id');
    }

}
