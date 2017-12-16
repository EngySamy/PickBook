<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';

    protected $fillable = ['user_id','item_id','value'];

    public static function Rate($id)
    {
    	DB::table('rating')->where('user_id','=',Auth::user()->id)->where('item_id','=',$id->id)->update(array('value'=>request()->rateval));
    }

}
