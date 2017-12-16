<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialOrderImage extends Model
{
    protected $table='specialorder_images';
    protected $fillable = [
        'link','order_id'
    ];
}
