<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedureTransaction extends Model
{
    protected $table = 'procedure_transaction';

    protected $fillable = ['procedure_id','transaction_id'];

    
}
