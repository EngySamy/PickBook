<?php

namespace App;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class SellRequest extends Model
{
   protected $fillable = [
        'name', 'width' ,'length', 'height' , 'price' , 'colortype_id' , 'artschool_id' ,'seller_id'
    ];

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

    public function images()
    {
    	return $this->hasMany('App\SellRequestsImage','request_id');
    }

    public function QS()
    {
        return $this->belongsTo('App\User','qs_id');
    }

    public function Replies()
    {
        return $this->hasMany('App\SellReply','request_id');
    }

    public static function UpdateReq($req)
    {
        return DB::table('sell_requests')->where('id','=',$req)->update(array('qs_id'=> Auth::user()->id));
    }

    public static function Close($id)
    {
        DB::table('sell_requests')->where('id','=',$id)->update(array('closed' => true));
    }
}
