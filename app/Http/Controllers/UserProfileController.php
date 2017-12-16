<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use User;
use App\Providers\ValidatorProvider;
use Validator;
use DB;
use Redirect;

class UserProfileController extends Controller
{
    public function View(Request $request)
    {
        if(Auth::check()&&Auth::user()->role==1)
        {
        	$user=Auth::user();
        	return view('ViewProfile',['user'=>$user]);
        }
        else
            abort(404);
    }

    public function Edit(Request $request)
    {
        if(Auth::check()&&Auth::user()->role==1)
        {
        	$user=Auth::user();
        	$arr = explode(" ", $user->name, 2);
        	return view('EditProfile',['user'=>$user,'arr'=>$arr]);
        }
        else
            abort(404);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'First_Name' => 'required|max:20|alpha',
            'Last_Name' => 'required|max:20|alpha',
            'Email' => 'required|email|max:255',
            'Password' =>'required|MatchingUserPassword',
            'Address'=>'required|regex:/^[a-zA-Z0-9\s,]+$/',
            'Phone'=>'required|numeric',
        ]);
    }
    protected function Store(array $data)
    {
        Auth::user()->UpdateData($data);
    }

    public function SubmitEdit(Request $request)
    {
        if(Auth::check()&&Auth::user()->role==1)
        {
        	$user=Auth::user();
        	$data=$request->all();
        	
    		$validator=$this->validator($data);
    	 	if ($validator->fails()) 
            	{return redirect()->back()->withErrors($validator)->withInput();}
        	else
        		{ 
        			$this->Store($data);
        			return redirect('/myprofile');
        		}
        }
        else
            abort(404);
    }

	public function ChangePassword(Request $request)
    {
        if(Auth::check()&&Auth::user()->role==1)
        {
        	$user=Auth::user();
        	$data=$request->all();
        	 $messages  = [
              'Password.required' => 'The new password field is required.'
              ];
        	
    		$validator=Validator::make($data, [
                'Old' =>'required|MatchingUserPassword',
                'Password' => 'required|min:6|confirmed'
            ],$messages);

            if ($validator->fails()) 
            	{return redirect()->back()->withErrors($validator)->withInput();}
        	else
        		{ 
        			Auth::user()->UpdatePassword($data);
    	    		return Redirect::to('myprofile')->with('message', 'Your password has changed successfully.');
        		}
        }
        else
            abort(404);
    }

}
