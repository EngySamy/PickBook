<?php

namespace App;
use DB;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function InterestedIn()        //interested in categories!
    {
        return $this->belongsToMany('App\Category','customer_interests','user_id','category_id');
    }

    public static function UpdateData($data)
    {
        DB::table('users')->where('id','=',Auth::user()->id)->update(array(
            'name'=>$data['First_Name'].' '.$data['Last_Name'],
            'email' => $data['Email'],
            'address'=>trim($data['Address']),
            'phone'=>$data['Phone']
            ));
    }

    public static function UpdatePassword($data)
    {
        DB::table('users')->where('id','=',Auth::user()->id)->update(array(
                    'password' => bcrypt($data['Password'])
                    ));
    }
}
