<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublisherRequestsImage extends Model ////////////////////////Requests
{
    //
    protected $table = 'publisher_requests_images';
     protected $fillable = [
        'link','request_id'
    ];
}
