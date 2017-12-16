<?php

namespace App;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class SellReply extends Model
{
	protected $fillable = [
        'text','isCustomer','request_id'
    ];
    
    public function Request()
    {
    	return $this->belongsTo('App\SellRequest','request_id');
    }

    public static function GetAll($userid)
    {
    	return DB::table('sell_replies')
                ->join('sell_requests', function ($join) use($userid) {  
                    $join->on('sell_replies.request_id', '=', 'sell_requests.id')
                    ->where('sell_requests.seller_id','=', $userid );
                })
                ->orderBy('sell_replies.created_at', 'desc')
                ->groupBy('request_id')
                ->select('request_id as req','name as reqName','sell_replies.created_at')
                ->get();
    }

    public static function Get($req)
    {
    	return DB::table('sell_replies')
                ->where('request_id','=',$req)
                ->orderBy('created_at', 'desc')
                ->get();
    }
}
