<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
         'customer_text' ,'customer_id', 'hr_id' , 'reply_text'
    ];
      
}
