<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'author', 'price' , 'language_id' , 'category_id' ,'publisher_id']; //this is required for insertion in tinker!

    /*Relationships definitions for fast access. This is the benefit of ORM. These functions are equivalent to multiple selects and joins.*/

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language','language_id');
    }

    public function publisher()
    {
    	return $this->belongsTo('App\User','publisher_id');
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
