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

class ContactusController extends Controller
{
public function index()
    {
      if(Auth::check())
        {if(Auth::user()->role==1)
    	     return view('contactus');
        else return view('sorry');
        }
      else return Redirect::to('login')->with('message', 'Login/Register to use this feature.');
    }


public function submitcomplaint()
    {  if(Auth::check())
              {  if(Auth::user()->role==1)
                      { $complaint0=\Request::get('complaint');
                        
                        $complaint=trim($complaint0);
                        if($complaint!="")

                            {
                              $complaintRequest=complaint::create([
                                    'customer_text'=>$complaint,
                                      'customer_id'=>Auth::user()->id,
                                    ]);
                                      
                          	  return view('ThankYou');
                            }
                            else return redirect::to('contactus')->with('message','Please write at least one character');
                          }
                        else return view('sorry');

                }      
          else
            return Redirect::to('login')->with('message', 'Login/Register to use this feature.');
             
    }
public function submitsuggestion()
    {
      if(Auth::check())
          {     if(Auth::user()->role==1)
                          {  
                           $suggestion0=\Request::get('suggestion');
                           $suggestion=trim($suggestion0);
                           if($suggestion!="")
                              { 
                                $suggestionRequest = suggestion::create(['text'=>$suggestion,'customer_id'=>Auth::user()->id,]);
                                return view('ThankYou');
                              }
                            else  return redirect::to('contactus')->with('message','Please write at least one character');
                          }         
                else return view('sorry');
          }                  
             
          
      else
            return Redirect::to('login')->with('message', 'Login/Register to use this feature.');
      

    }




  }