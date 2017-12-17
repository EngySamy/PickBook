<?php

namespace App;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class SpecialOrder extends Model
{
	protected $table='special_orders_basic';
    protected $fillable = ['name', 'author', 'price' , 'language_id' , 'category_id' ,'requester_id'];


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
    	return $this->belongsTo('App\User','requester_id');
    }

    public function images()
    {
    	return $this->hasMany('App\SpecialOrderImage','order_id');
    }
    
    public static function Close($id)
    {
        DB::table('special_orders_basic')->where('id','=',$id)->update(array('closed' => true));
    }
}
