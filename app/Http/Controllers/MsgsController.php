<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BuyReply;
use App\BuyRequest;
use App\SellReply;
use App\SellRequest;
use App\SpecialOrderReply1;
use App\SpecialOrderReply2;
use App\SpecialOrder;
use App\SpecialOrderSimilar;
use DB;
use Auth;

class MsgsController extends Controller
{
    public function Inbox($id,Request $request)
    {
        if(Auth::check()&&Auth::user()->role==1)//customer
        {
            $userid=Auth::user()->id;
            if($id==0) //sell replies
            { 
                $Replies=SellReply::GetAll($userid);
            }
            elseif ($id==2) {  //buy replies
                $Replies=BuyReply::GetAll($userid);
            }

            elseif ($id==1) {  //special orders replies
                $Replies=SpecialOrderReply1::GetAll($userid);
            }
            elseif ($id==3) {  //similar special orders replies
                $Replies=SpecialOrderReply2::GetAll($userid);
            }
            else
                {abort(404);}

           
            return view('Msg',['Replies'=>$Replies,'id'=>$id]);
        }
        else 
            abort(404);
    }

    public function Msg($id,$req,Request $request)
    {
        $userid=Auth::user()->id;
       if(Auth::check()&&Auth::user()->role==1)//customer
        {
            if($id==0) //sell replies
            {
                $reqReplies=SellReply::Get($req);

                $Close=SellRequest::where('id','=',$req)
                ->select('closed','seller_id')
                ->first();
                $user=$Close->seller_id; //this check for be sure that the logged in user is the owner of the message and the request
               if ($user!=$userid) {
                    abort(404);
                }   
                
            }
            elseif ($id==2) {  //buy replies
                $reqReplies=BuyReply::Get($req);

                $Close=BuyRequest::where('id','=',$req)
                ->select('closed','buyer_id')
                ->first();
                $user=$Close->buyer_id;
                if ($user!=$userid) {
                    abort(404);
                }   

            }

            elseif ($id==1) {  //special orders replies
                $reqReplies=SpecialOrderReply1::Get($req);

                $Close=SpecialOrder::where('id','=',$req)
                ->select('closed','requester_id')
                ->first();

                $user=$Close->requester_id;
                if ($user!=$userid) {
                    abort(404);
                }   

              }   
            elseif ($id==3) {  //similar special orders replies
                $reqReplies=SpecialOrderReply2::Get($req);

                $Close=SpecialOrderSimilar::where('id','=',$req)
                ->select('closed','requester_id')
                ->first();

                $user=$Close->requester_id;
                if ($user!=$userid) {
                    abort(404);
                }   

                            
            }
            else
                {abort(404);}

            if($reqReplies==null)
                {abort(404);} 


            return view('MsgDetail',['reqReplies'=>$reqReplies,'id'=>$id,'req'=>$req,'Close'=>$Close]);
        }
        else 
            abort(404);
        
    }


    public function Reply($id,$req,Request $request)
    {
       if(Auth::check()&&(Auth::user()->role==1||Auth::user()->role==2))//customer or qs
        {
            $role=$request->input('role');
            $customer=false;
            if($role==1) //customer
                $customer=true;
            elseif($role==2)
                $customer=false;
            else
                abort(404);

            $text=$request->input('reply');
            if($text=="")
                return redirect()->back();
            $userid=Auth::user()->id; 
            if($id==0) //sell replies
            {
                if($role==1)//customer -> check he is the seller
                    $check=SellRequest::where('id','=',$req)->where('seller_id','=',$userid)->first();
                else  // QS -> check he is the assigned QS
                    $check=SellRequest::where('id','=',$req)->where('qs_id','=',$userid)->first();
                if($check==null)
                    abort(404); 

                SellReply::create(array(
                    'text'=>$text,
                    'isCustomer'=>$customer,
                    'request_id'=>$req
                    ));
                
            }
            elseif ($id==2) {  //buy replies

                if($role==1)//customer -> check he is the buyer
                    $check=BuyRequest::where('id','=',$req)->where('buyer_id','=',$userid)->first();
                else  // QS -> check he is the assigned QS
                    $check=BuyRequest::where('id','=',$req)->where('qs_id','=',$userid)->first();
                if($check==null)
                    abort(404); 

                 BuyReply::create(array(
                    'text'=>$text,
                    'isCustomer'=>$customer,
                    'request_id'=>$req
                    ));

            }

            elseif ($id==1) {  //special orders replies

                if($role==1)//customer -> check he is the requester
                    $check=SpecialOrder::where('id','=',$req)->where('requester_id','=',$userid)->first();
                else  // QS -> check he is the assigned QS
                    $check=SpecialOrder::where('id','=',$req)->where('qs_id','=',$userid)->first();
                if($check==null)
                    abort(404); 

                    SpecialOrderReply1::create(array(
                    'text'=>$text,
                    'isCustomer'=>$customer,
                    'sorder_id'=>$req
                    ));            
            }
            elseif ($id==3) {  // similar special orders replies

                if($role==1)//customer -> check he is the requester
                    $check=SpecialOrderSimilar::where('id','=',$req)->where('requester_id','=',$userid)->first();
                else  // QS -> check he is the assigned QS
                    $check=SpecialOrderSimilar::where('id','=',$req)->where('qs_id','=',$userid)->first();
                if($check==null)
                    abort(404); 

                    SpecialOrderReply2::create(array(
                    'text'=>$text,
                    'isCustomer'=>$customer,
                    'sorder_id'=>$req
                    ));             
            }
            else
                {abort(404);}
          
            return redirect()->back();
        }
        else 
            abort(404);
    }
}
