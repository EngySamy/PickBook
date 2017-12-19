<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = ['user_id','item_id','value'];

    public static function Review($user,$item,$value)
    {
        Review::create(['value'=>$value,'user_id'=>$user,'item_id'=>$item]);
    }
    
    public static  function getItemReviews($item){
        $reviews=Review::where('item_id','=',$item)->get();//Review::where('item_id','=',$item);
        return $reviews;
    }

}
