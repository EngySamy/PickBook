<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PublisherRequest;
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

class AdminHomeController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            return view('AdminHome');
        else
            abort(404);
        
    }

    public function ViewAddPublisher(Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
            return view('AddPublisher');
        else
            abort(404);

    }
    ////////////////////////////////////////////////////////////////////////////////////////////

    public function ValidatePublisher (Request $request)
    {
        $messages  = [
            'MatchingUserPassword' => 'Wrong password. Try again please.',
        ];

        $rules = [
            'First_Name' => 'required|max:20|alpha',
            'Last_Name' => 'required|max:20|alpha',
            'Email' => 'required|email|max:255|unique:users|confirmed',
            'Password' => 'required|min:6|confirmed',
        ];

        $validator= Validator::make($request->all(),$rules,$messages);

        return $validator;
    }

    protected function StorePublisher(array $data) //store publisher
    {
        $user = User::create([
            'name' => $data['First_Name'].' '.$data['Last_Name'],
            'email' => $data['Email'],
            'password' => bcrypt($data['Password']),
            'address'=>"a",
            'phone'=>"0",
        ]);

        $insertedID = $user->id;
        $user->username = strtolower($data['First_Name'][0]).strtolower($data['Last_Name'][0]).($insertedID*11).rand(100,999);


        $user->role=4; //publisher
        $user->save();

        return $user;
    }

    public function AddPublisher(Request $request)
    {
        $data=$request->all();

        //$FinishCode = 0;
        if(Auth::check() && Auth::user()->role==2)
        {
            $validator=$this->ValidatePublisher($request);
            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            else {
                $u = $this->StorePublisher($data);

                return view('Done');
            }

        }
        else
        {return abort(404);}
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    public function ShowCustomerInfo($customer,Request $request) //???where is it?
    {
         if(Auth::check()&&Auth::user()->role==2)
            {
                $user=User::where('id','=',$customer)->first();
                if($user==null)
                    abort(404);
                return view('UserProfile',['user'=>$user]);
            }
        else
            abort(404);
    }
    ///////////////////////////


    public function RemoveBook($item,Request $request){
        if(Auth::check()&&Auth::user()->role==2)
        {
            //$item=Item::where('id','=',$item)->first();
            Item::destroy($item);

            return view('Done');
        }
        else
            abort(404);
    }

    ////////////////////////////////////////////////
    public function GoToRemoveUser(Request $request){
        if(Auth::check()&&Auth::user()->role==2)
        {
            return view('removeUser');
        }
        else
            abort(404);
    }

    public function ValidateInput ( Request $request)
    {
        $messages  = [
            'MatchingUserPassword' => 'Wrong password. Try again please.',
        ];

        $rules = [
            'Username' => 'required|max:20|regex:/^[a-zA-Z0-9\s_]+$/',
            'Password' =>'required|MatchingUserPassword',
        ];

        $validator= Validator::make($request->all(),$rules,$messages);
        return $validator;
    }

    protected function RemoveUser( Request $request)
    {
        if(Auth::check()&&Auth::user()->role==2)
        {
            $validator=$this->ValidateInput($request);
            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();
            else{
                $data=$request->all();
                $user=User::where('username','=',$data['Username']);
                if($user->count()==0)
                    return redirect()->back()->with('message', 'No Customer/Publisher is found with this username!');
                $user->delete();
                return view('Done');
            }

        }
        else
            abort(404);

    }

}
