<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class BuyRequest extends Model
{
    protected $table = 'buy_requests';
    protected $fillable = [
        'name','item_id','buyer_id'
    ];

    public function Customer()
    {
    	return $this->belongsTo('App\User','buyer_id');
    }

    public function Item()
    {
    	return $this->belongsTo('App\Item','item_id');
    }
    

    public static function Archive($req)
    {
        DB::table('buy_requests')->where('id','=',$req)->update(array('closed' => true));
    }
}
