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

    
    public function ShowItem($id,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            {
                $item=Item::where('id','=',$id)->first();
                if($item==null)
                    {
                        abort(404);
                    }
                $images = $item->images;
                $avg = $item->AverageRating();
                return view('item',['item'=>$item,'images'=>$images,'avg_rate'=>$avg]);
            }
        else
            abort(404);
    } 

    

    public function ArchiveBuy_Similar($id,$req,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            {
                if($id!=2 && $id!=3)
                    abort(404);
                

                $validator= Validator::make($request->all(),[
                    'Password' =>'required|MatchingUserPassword',
                     ]); 

                if ($validator->fails()) 
                        {return redirect()->back()->withErrors($validator)->withInput();}
                else
                    { 
                        // archive
                        if($id==2) //buy
                            BuyRequest::Archive($req);
                        else
                            SpecialOrderSimilar::Archive($req);
                        return view('Done');
                    }
             }
        else
            abort(404);
    }
    

    public function ReofferItem($id,$req,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)//customer
        {
            if($id!=2)
                abort(404);
            else
            {
                $ItemID = BuyRequest::where('id','=',$req)->select('item_id')->first();
                if($ItemID!=null)
                {
                    $itemid = $ItemID->item_id;
                    $item = Item::where('id','=',$itemid)->update(array('sold'=>false,'buyer_id'=>null));
                    //Archive
                    return $this->ArchiveBuy_Similar(2,$req,$request); 
                }
                else abort(404);
            } 

        }
        else 
            abort(404);
    }
}
