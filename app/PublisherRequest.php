<?php

namespace App;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class PublisherRequest extends Model
{
   protected $fillable = [
        'name', 'width' ,'length', 'height' , 'price' , 'language_id' , 'category_id' ,'publisher_id'
    ];

    public function category()
    {
    	return $this->belongsTo('App\Category','category_id');
    }

    public function language()
    {
    	return $this->belongsTo('App\Language','language_id');
    }

    public function Customer()
    {
    	return $this->belongsTo('App\User','publisher_id');
    }

    public function images()
    {
    	return $this->hasMany('App\PublisherRequestsImage','request_id');
    }
 

    public static function Close($id)
    {
        DB::table('publisher_requests')->where('id','=',$id)->update(array('closed' => true));
    }
}
