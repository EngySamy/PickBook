<?php

namespace App;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class BuyReply extends Model
{
    protected $fillable = [
        'text','isCustomer','request_id'
    ];

    public function Request()
    {
    	return $this->belongsTo('App\BuyRequest','request_id');
    }

    public static function GetAll($userid)
    {
    	return DB::table('buy_replies')
                    ->join('buy_requests', function ($join) use($userid) {  
                        $join->on('buy_replies.request_id', '=', 'buy_requests.id')
                        ->where('buy_requests.buyer_id','=', $userid );
                })
                ->orderBy('buy_replies.created_at', 'desc')
                ->groupBy('request_id')
                ->select('request_id as req','name as reqName','buy_replies.created_at')
                ->get();
    }

    public static function Get($req)
    {
    	return DB::table('buy_replies')
                ->where('request_id','=',$req)
                ->orderBy('created_at', 'desc')
                ->get();
    }
}
