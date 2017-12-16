<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'width' ,'length', 'height' , 'price' , 'colortype_id' , 'artschool_id' ,'seller_id']; //this is required for insertion in tinker!

    /*Relationships definitions for fast access. This is the benefit of ORM. These functions are equivalent to multiple selects and joins.*/

    public function artSchool()
    {
    	return $this->belongsTo('App\ArtSchool','artschool_id');
    }

    public function colorType()
    {
    	return $this->belongsTo('App\ColorType','colortype_id');
    }

    public function Customer()
    {
    	return $this->belongsTo('App\User','seller_id');
    }

    public function Raters()
    {
    	return $this->belongsToMany('App\User','rating','item_id','user_id');
    }

    public function AverageRating()
    {
    	$raters = $this->Raters();
    	if($raters->count()==0)
    		return 0;
    	else
        {
         		return (int) ceil($raters->avg('value'));
        }
    }

    public function images()
    {
    	return $this->hasMany('App\ItemImage','item_id');
    }

}
