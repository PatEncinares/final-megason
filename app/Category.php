<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Inventory;
use App\User;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name','description'];

    public function items(){
        return $this->hasMany('App\Inventory');
    }
}
