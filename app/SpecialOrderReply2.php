<?php

namespace App;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class SpecialOrderReply2 extends Model
{
    protected $table='special_order_replies2';
    protected $fillable = [
        'text','isCustomer','sorder_id'
    ];
    public function Request()
    {
    	return $this->belongsTo('App\SpecialOrderSimilar','similaritem_id');
    }

    public static function GetAll($userid)
    {
    	return DB::table('special_order_replies2')
                ->join('special_orders_similar', function ($join) use($userid) {  
                    $join->on('special_order_replies2.sorder_id', '=', 'special_orders_similar.id')
                    ->where('special_orders_similar.requester_id','=', $userid );
                })
                ->orderBy('special_order_replies2.created_at', 'desc')
                ->groupBy('sorder_id')
                ->select('sorder_id as req','name as reqName','special_order_replies2.created_at')
                ->get();  
    }

    public static function Get($req)
    {
    	return DB::table('special_order_replies2')
                ->where('sorder_id','=',$req)
                ->orderBy('created_at', 'desc')
                ->get();
    }
}
