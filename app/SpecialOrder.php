<?php

namespace App;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class SpecialOrder extends Model
{
	protected $table='special_orders_basic';
    protected $fillable = ['name', 'width' ,'length', 'height' , 'price' , 'colortype_id' , 'artschool_id' ,'requester_id','similaritem_id'];


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
    	return $this->belongsTo('App\User','requester_id');
    }

    public function images()
    {
    	return $this->hasMany('App\SpecialOrderImage','order_id');
    }

    public function QS()
    {
        return $this->belongsTo('App\User','qs_id');
    }

    public static function UpdateReq($req)
    {
        return DB::table('special_orders_basic')->where('id','=',$req)->update(array('qs_id'=> Auth::user()->id));
    }

    public static function Close($id)
    {
        DB::table('special_orders_basic')->where('id','=',$id)->update(array('closed' => true));
    }
}
