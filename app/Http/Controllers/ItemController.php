<?php

namespace App\Http\Controllers;

use App\Review;
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

            //if(Auth::check())
            //{
                $user_id = Auth::user()->id;
                $user_rate = ItemController::getRatingForUser($itemid,$user_id);
            //}

            $avg = $item->AverageRating();
            
            $reviews=Review::getItemReviews($itemid);

            return view('item',['item'=>$item,'images'=>$images,'rate'=>$user_rate,'avg_rate'=>$avg,'reviews'=>$reviews]);
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
        if(count($check)!=0)
            return -1;

       $check2=Item::where('id','=',$item)->select('publisher_id')->first();
       if($check2->publisher_id==Auth::user()->id)
            return -2; // the publisher is the buyer !!
        
        $buyRequest = BuyRequest::create([
          'name'=>Item::where('id','=',$item)->select('name')->first()->name,
          'item_id'=>$item,
          'buyer_id'=>Auth::user()->id,  
        ]);

        return 1;

    }


    public function Buy($item, Request $request) // id to choose between buy request and similar special order
    {
        if(Auth::check()&&(Auth::user()->role==1||Auth::user()->role==4))
        {
            $rules = [
                'Password' =>'required|MatchingUserPassword',
                 ];

            $validator= Validator::make($request->all(),$rules); 
            if ($validator->fails()) 
                {return redirect()->back()->withErrors($validator)->withInput()->with('message', 'Wrong Password. Try again please.');}
            else
                {
                     //buy req
                    $check=$this->StoreBuyRequest($item);

                    if ($check==-2) {
                        return redirect()->back()->with('message', 'You are the publisher of this book! You can not order it.');
                    }
                    elseif($check==-1) {
                        return redirect()->back()->with('message', 'You have been ordered this book previously!');
                    }
                    else
                        return redirect('/home/ThankYou');
                }
        }
        else 
            abort(404);
    }
    public function review($id,Request $request)
    {
        if(Auth::check())
        {
            $data=$request->all();
            Review::Review(Auth::user()->id,$id,$data['review']);

            return redirect()->back()->with('message', 'Your review has been added successfully!');
        }
        else {
            return Redirect::to('login')->with('message', 'Login/Register to use this feature.');
        }
    }

}
