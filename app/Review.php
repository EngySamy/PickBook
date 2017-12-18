<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'rating';

    protected $fillable = ['user_id','item_id','value'];

    public static function Review($user,$item,$value)
    {
        //DB::table('rating')->where('user_id','=',Auth::user()->id)->where('item_id','=',$id->id)->update(array('value'=>request()->rateval));

        Review::create(['value'=>$value,'user_id'=>$user,'item_id'=>$item]);
    }
    
    public static  function getItemReviews($item){
        $reviews=Review::where('item_id','=',$item);
        return $reviews;
    }

}
