<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\User;

class Inventory extends Model
{
    protected $table = 'inventories';

    protected $fillable = ['category_id','item_name','item_description','item_price','quantity','arrival_date','expiration_date','add_stock','pull_out_stock','updated_by'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function updatedby(){
        return $this->belongsTo('App\User','updated_by');
    }
}
