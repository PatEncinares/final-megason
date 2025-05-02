<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['lab_result_id','attachment_filepath','attachment_ext','attachment_filename'];

}
