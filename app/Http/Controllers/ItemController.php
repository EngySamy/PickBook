<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Item;

use App\Rating;

use Auth;

use DB;

use Session;

use Redirect;

use Validator;
use App\Providers\ValidatorProvider;
use App\BuyRequest;
use App\SpecialOrderSimilar;

class ItemController extends Controller
{
    //
    public function show($itemid)
    {

        if(Auth::check())
        {
            $item = Item::where('id','=',$itemid)->first();
       
            if($item==null)
            {
                abort(404);
            }

            $images = $item->images;
            $user_rate=0;
            //if(Auth::check())
            //{
                $user_id = Auth::user()->id;
                $user_rate = ItemController::getRatingForUser($item,$user_id);
            //}

            $avg = $item->AverageRating();

            return view('item',['item'=>$item,'images'=>$images,'rate'=>$user_rate,'avg_rate'=>$avg]);
        }
        else {
            return Redirect::to('login')->with('message', 'Login/Register to use this feature.');
        }
    	
    }

    public function rate(Item $id)
    {
    	if(Auth::check())
    	{
            if(request()->rateval>0)
    		{
            $rate = Rating::firstOrCreate(array('user_id'=>(Auth::user()->id),'item_id'=>($id->id)));
    		Rating::Rate($id);
    		return back()->with('message','Your rating has been submitted successfully.');
            }
            else return back()->with('message','Rating is done by giving from 1 to 5 stars.');
    	}
    	else {
    		return Redirect::to('login')->with('message', 'Login/Register to use this feature.');
    	}
    }

    public function getRatingForUser($item_id,$user_id)
    {
    	$rates = Rating::where('user_id','=',$user_id)->where('item_id','=',$item_id)->get();
    	if($rates)
    		{
    			foreach($rates as $index=>$rate)
    			{
    				if($index==0)
    				{
    					return $rate->value;
    				}
    			}
    		}
    	else return 0;
    }



    protected function StoreBuyRequest ($item)
    {
       $check=BuyRequest::where('item_id','=',$item)->where('buyer_id','=',Auth::user()->id)->first();
 
       $check2=Item::where('id','=',$item)->select('seller_id','sold')->first();

       if(count($check)!=0&&$check2->sold==true)
           return -1; //item sold and the button still exist ! because another one ordered from little time
     
       if($check2->seller_id==Auth::user()->id)
            return -2; // the seller is the buyer !!
        $buyRequest = BuyRequest::create([
          'name'=>Item::where('id','=',$item)->select('name')->first()->name,
          'item_id'=>$item,
          'buyer_id'=>Auth::user()->id,  
        ]);
        BuyRequest::Store($item);
        return 1;

    }

    protected function CheckExist_StoreSimilarOrder ($item)
    {
        $check=SpecialOrderSimilar::where('similaritem_id','=',$item)->where('requester_id','=',Auth::user()->id)->first();
        if(count($check)!=0)
           return 0;
       $check2=Item::where('id','=',$item)->select('seller_id','buyer_id')->first();
       if($check2->seller_id==Auth::user()->id)
            return -2; //the seller is the requester!!
        $similarOrder = SpecialOrderSimilar::create([
          'name'=>Item::where('id','=',$item)->select('name')->first()->name,
          'similaritem_id'=>$item,
          'requester_id'=>Auth::user()->id,  
        ]);
        return 1;

    }

    public function Buy_Similar($id,$item, Request $request) // id to choose between buy request and similar special order
    {
        if($id!=2 && $id!=3)
            abort(404);
        if(Auth::check()&&Auth::user()->role==1)
        {
            $rules = [
                'Password' =>'required|MatchingUserPassword',
                 ];

            $validator= Validator::make($request->all(),$rules); 
            if ($validator->fails()) 
                {return redirect()->back()->withErrors($validator)->withInput()->with('message', 'Wrong Password. Try again please.');}
            else
                {
                    if($id==2) //buy req 
                        $check=$this->StoreBuyRequest($item);
                    else //similar sp order
                        $check=$this->CheckExist_StoreSimilarOrder($item);
                    if($check==0)
                        return redirect()->back()->with('message', 'You have already ordered this special order !');
                    elseif($check==-1)
                        return redirect()->back()->with('message', 'This item has been already sold . We are Sorry.');
                    elseif ($check==-2) {
                        return redirect()->back()->with('message', 'You are the seller of this item! You can not order it.');
                    }
                    else
                        return redirect('/home/ThankYou');
                }
        }
        else 
            abort(404);
    }
}
