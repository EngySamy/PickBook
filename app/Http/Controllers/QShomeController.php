<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SellRequest;
use Config;
use App\Item;
use Validator;
use Redirect;
use DB;
use App\BuyRequest;
use App\User;
use Auth;
use App\SpecialOrder;
use App\Providers\ValidatorProvider;

class QShomeController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            return view('QShome');
        else
            abort(404);
        
    }

    public function ShowCustomerInfo($customer,Request $request)
    {
         if(Auth::check()&&Auth::user()->role==2)
            {
                $user=User::where('id','=',$customer)->first();
                if($user==null)
                    {
                        abort(404);
                    }
                return view('UserProfile',['user'=>$user]);
            }
        else
            abort(404);
    } 



}
