<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;
use Validator;
use App\BuyRequest;
use App\SpecialOrderSimilar;
use App\SpecialOrderReply2;
use App\Item;
use App\BuyReply;

class AdminBuyController extends Controller
{
    public function ShowBuy( Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            {
                $Requests = null;

                $Requests= BuyRequest::orderBy('created_at', 'DESC')->where('closed','=','false');

                if(!is_null($Requests)) 
                    $Requests=$Requests->paginate(15);

                return view('AdminBuy',['Requests'=>$Requests]);
            }
        else
            abort(404);
        
    }   

    

    public function ArchiveBuy($req,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            {
                $validator= Validator::make($request->all(),[
                    'Password' =>'required|MatchingUserPassword',
                     ]); 

                if ($validator->fails()) 
                        {return redirect()->back()->withErrors($validator)->withInput();}
                else
                    { 
                        // archive
                        BuyRequest::Archive($req);
                        return view('Done');
                    }
             }
        else
            abort(404);
    }
    

}
