<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class SpecialOrderSimilar extends Model
{
    protected $table='special_orders_similar';
    protected $fillable = [
        'name','similaritem_id','requester_id'
    ];
    public function Customer()
    {
    	return $this->belongsTo('App\User','requester_id');
    }

    public function Item()
    {
    	return $this->belongsTo('App\Item','similaritem_id');
    }

    public function QS()
    {
        return $this->belongsTo('App\User','qs_id');
    }

    public static function Archive($req)
    {
        DB::table('special_orders_similar')->where('id','=',$req)->update(array('closed' => true));
    }
}
