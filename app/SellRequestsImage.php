<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellRequestsImage extends Model ////////////////////////Requests
{
    //
    protected $table = 'sellrequest_images'; 
     protected $fillable = [
        'link','request_id'
    ];
}
