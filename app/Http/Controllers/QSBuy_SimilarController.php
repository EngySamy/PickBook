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

class QSBuy_SimilarController extends Controller
{
    public function ShowBuy_Similar($id,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            {
                if($id!=2 && $id!=3)
                    abort(404);
                $Requests = null;
                if($id==2) //buy
                    $Requests= BuyRequest::orderBy('created_at', 'DESC')->where('closed','=','false'); 
                else
                    $Requests= SpecialOrderSimilar::orderBy('created_at', 'DESC')->where('closed','=','false');
                if(!is_null($Requests)) 
                    $Requests=$Requests->paginate(15);
                $qs=Auth::user()->id;
                return view('QSBuy_Similar',['Requests'=>$Requests,'qs'=>$qs,'id'=>$id]);
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

    public function ServeBuy_Similar($id,$req,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            {
                if($id!=2 && $id!=3)
                    abort(404);
                if($id==2) //buy
                {
                    $affected=DB::table('buy_requests')->where('id','=',$req)->update(array('qs_id'=> Auth::user()->id));
                }
                else
                     $affected=DB::table('special_orders_similar')->where('id','=',$req)->update(array('qs_id'=> Auth::user()->id));
                
                if($affected==0)
                    {abort(404);}
                return redirect()->back();
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


    public function MsgInBuy_Similar($id,$req,Request $request)
    {
         if(Auth::check()&&Auth::user()->role==2)//customer
        {
            if($id!=2 && $id!=3)
                abort(404);
            if($id==2) 
            {
                $reqReplies = BuyReply::Get($req);

                $Close=BuyRequest::where('id','=',$req)
                    ->select('closed')
                    ->first();
            } 
            else{
                $reqReplies=SpecialOrderReply2::Get($req);

                $Close=SpecialOrderSimilar::where('id','=',$req)
                    ->select('closed')
                    ->first();
            } 
          
            return view('MsgDetail',['reqReplies'=>$reqReplies,'req'=>$req,'id'=>$id,'Close'=>$Close]); 
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
