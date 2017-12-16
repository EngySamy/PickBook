<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Item;
use Auth;

class ProfileItemsController extends Controller
{

    public function index($id,Request $request)
    {
    	if(Auth::check())
        {
	    	$user=User::where('id','=',$id)->first();
	    	$items=Item::where('seller_id','=',$id);
	    	//$items = item::with('images');
	    	if(!is_null($items))
	            $items=$items->paginate(6);   
	    	return view('ProfileItems',['user'=>$user, 'items'=>$items]);
	    }
        else
            abort(404);
    }
}
