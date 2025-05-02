<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Permission;

class UserType extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->hasMany('App\User','type');
    }

    public function permissions(){
        return $this->hasMany('App\Permission','type_id');
    }
}
