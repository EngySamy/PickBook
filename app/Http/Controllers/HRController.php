<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Redirect;
use Auth;
use App\Http\Requests;

use Validator;
use App\Providers\ValidatorProvider;
use Illuminate\Support\Facades\Input;


use Illuminate\Http\Request;

use App\user;
use App\Suggestion;
use App\Complaint;

class HRController extends Controller
{
public function index()
    {  if(Auth::check()&&Auth::user()->role==3)
    	return view('HRPanel');
      else 
        return view('sorry');
    }
public function viewcomplaints()
    {
      if(Auth::check())
        {if (Auth::user()->role==3)
                { $complaints=complaint::orderby ('created_at','desc');
                  if($complaints!=null)
                     $complaints = $complaints->paginate(15);
                 return view('complaints',['complaints'=>$complaints]);
                }

          else
            return view('sorry');
        }
        else
          return Redirect::to('login')->with('message', 'Login/Register to use this feature.');
    }

public function viewsuggestions()
    {
      if(Auth::check())
        {
          if(Auth::user()->role==3)
              {  
                 $suggestions=suggestion::orderby ('created_at','desc');
                  if($suggestions!=null)
                     $suggestions = $suggestions->paginate(15);
                 return view('suggestions',['suggestions'=>$suggestions]);
              }
          else
                 return view ('sorry'); 
        } 
      else
           return Redirect::to('login')->with('message', 'Login/Register to use this feature.');
    }





}