<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SellRequest;
use App\SellRequestsImage;
use App\SpecialOrder;
use App\SpecialOrderImage;
use App\SpecialOrderReply1;
use App\SellReply;
use App\ItemImage;
use Auth;
use DB;
use Validator;
use App\Item;

class AdminSell_SpecialController extends Controller
{
    public function ShowSell_Special($id,Request $request)
    {
        if($id!=0 && $id!=1)
            abort(404);
        if(Auth::check()&&Auth::user()->role==2)
            {
            	if($id==0) //sell request
            	{
            		$Requests= SellRequest::orderBy('created_at', 'DESC')->where('closed','=','false'); 
                	if(!is_null($Requests)) 
                        $Requests=$Requests->paginate(15);
            	}
            	else { //id=1
            		$Requests= SpecialOrder::orderBy('created_at', 'DESC')->where('closed','=','false'); 
                	if(!is_null($Requests)) 
                        $Requests=$Requests->paginate(15);
            	}
                
                return view('AdminSell_Special',['Requests'=>$Requests,'id'=>$id]);
            }
        else
            abort(404);
    }    

    public function ShowSell_SpecialDetail($id,$req,Request $request)// 
    {
        if(Auth::check()&&Auth::user()->role==2)
            {
                if($id!=0 && $id!=1)
                    abort(404);
                if($id==0)
                        $Request= SellRequest::where('id','=',$req)->where('closed','=',false)->first();
                else
                	$Request= SpecialOrder::where('id','=',$req)->where('closed','=',false)->first();

                if($Request==null)
                        abort(404);

                $images = $Request->images;
                $qs=Auth::user()->id;
                return view('Sell_SpecialDetails',['Request'=>$Request,'images'=>$images,'qs'=>$qs,'id'=>$id]);
                }
        else
            abort(404);
        
    }  
    public function ServeSell_Special($id,$req,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            {
            	if($id!=0 && $id!=1)
                    abort(404);
                if($id==0)
	            	$affected=SellRequest::UpdateReq($req);
	            else
	            	$affected=SpecialOrder::UpdateReq($req);
	            
	            if($affected==0)
	                {abort(404);}
	            return redirect()->back();
             }
        else
            abort(404);
    }

    protected function NewItem($id,$newprice)
    {
        $sellRequest=SellRequest::where('id','=',$id)->first();
        if($sellRequest==null)
         {abort(404);}
         $newItem= Item::create(array(
                        'name'=>$sellRequest->name,
                        'width'=>$sellRequest->width,
                        'length'=>$sellRequest->length,
                        'height'=>$sellRequest->height,
                        
                        'artschool_id'=>$sellRequest->artschool_id,
                        'seller_id'=>$sellRequest->seller_id,
                        'price'=>$newprice,
                        'colortype_id'=>$sellRequest->colortype_id,
                        ));

         $images = $sellRequest->images;
         if($images!=null)
             foreach($images as $image)
                {
                   ItemImage::create(array('link'=>$image->link,'item_id'=>$newItem->id));
                }
        else abort(404);

        

    }

    public function AcceptSellRequest($id,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            {

             $validator= Validator::make($request->all(),[
                'Price' => 'required|numeric|digits_between:1,6',
                'Password' =>'required|MatchingUserPassword',
                 ]); 

             if ($validator->fails()) 
                    {return redirect()->back()->withErrors($validator)->withInput();}
                else
                    { 
                        $this->NewItem($id,$request->input('Price'));
                        // archive
                        SellRequest::Close($id);
                        return view('Done');
                    }
             }
        else
            abort(404);
    }

    public function RefuseSellRequest($id,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            {

             $validator= Validator::make($request->all(),[
                'Password' =>'required|MatchingUserPassword',
                // should be modified to check the qs password 
                 ]); 

             if ($validator->fails()) 
                    {return redirect()->back()->withErrors($validator)->withInput();}
                else
                    { 
                        // archive
                        SellRequest::Close($id);
                        return view('Done');
                    }
            }
        else
            abort(404);
    } 

    public function MsgInSell_Special($id,$req,Request $request)
    {
         if(Auth::check()&&Auth::user()->role==2)//customer
        {
            if($id!=0 && $id!=1)
                abort(404);
            if($id==0)
            {
                $reqReplies=SellReply::Get($req);

                $Close=SellRequest::where('id','=',$req)
                    ->select('closed')
                    ->first();
            }
            else
            {
                $reqReplies=SpecialOrderReply1::Get($req);

                $Close=SpecialOrder::where('id','=',$req)
                    ->select('closed')
                    ->first();
            }
        
            return view('MsgDetail',['reqReplies'=>$reqReplies,'req'=>$req,'id'=>$id,'Close'=>$Close]); 
        }
        else 
            abort(404);
    } 

///////////special
    public function ArchiveSpecialOrder($id,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            {

             $validator= Validator::make($request->all(),[
                'Password' =>'required|MatchingUserPassword',
                 ]); 

             if ($validator->fails()) 
                    {return Redirect::back()->with('message','Wrong password. Try again please.');}
                else
                    { 
                        // archive
                        SpecialOrder::Close($id);
                        return view('Done');
                    }
            }
        else
            abort(404);
    } 

}
