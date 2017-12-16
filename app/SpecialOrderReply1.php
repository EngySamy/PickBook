<?php

namespace App;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class SpecialOrderReply1 extends Model
{
    protected $table='special_order_replies1';
    protected $fillable = [
        'text','isCustomer','sorder_id'
    ];

    public static function GetAll($userid)
    {
    	return DB::table('special_order_replies1')
                ->join('special_orders_basic', function ($join) use($userid) {  
                    $join->on('special_order_replies1.sorder_id', '=', 'special_orders_basic.id')
                    ->where('special_orders_basic.requester_id','=', $userid );
                })
                ->orderBy('special_order_replies1.created_at', 'desc')
                ->groupBy('sorder_id')
                ->select('sorder_id as req','name as reqName','special_order_replies1.created_at')
                ->get();
    }

    public static function Get($req)
    {
    	return DB::table('special_order_replies1')
                ->where('sorder_id','=',$req)
                ->orderBy('created_at', 'desc')
                ->get();
    }
}
