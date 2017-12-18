<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Language;
use App\Item;
use App\BuyReply;
use App\BuyRequest;
use App\SellReply;
use App\PublisherRequest;
use App\SpecialOrderReply;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = item::with('images');
        if(!is_null($items))
            $items=$items->paginate(5);        //Display 10 items per page! This is magic! //Eager Loading!
        $categories = HomeController::showCategories();
        $languages = HomeController::showLanguages();
        return view('home',['categories'=>$categories,'languages'=>$languages,'items'=>$items , 'remove'=>false]);
    }

    public function index2(Request $request)
    {
        $items = item::with('images');
        if(!is_null($items))
            $items=$items->paginate(5);        //Display 10 items per page! This is magic! //Eager Loading!
        $categories = HomeController::showCategories();
        $languages = HomeController::showLanguages();
        if(Auth::check() && Auth::user()->role==2) //admin want remove book -- so show a message for that
            $remove=true;
        else
            $remove=false;
        return view('home',['categories'=>$categories,'languages'=>$languages,'items'=>$items ,'remove'=>$remove ]);
    }

    public function showCategories()
    {
        return Category::orderBy('name')->get();        //Sort ascendingly
    }

    public function showLanguages()
    {
        return Language::orderBy('name')->get();
    }

    public function showAllinCategory($id, Request $request)
    {
        $items = Item::where('category_id','=',$id)->paginate(10);
        $categories = HomeController::showCategories();
        $languages = HomeController::showLanguages();
        return view('home',['categories'=>$categories,'languages'=>$languages,'items'=>$items,'remove'=>false]);
    }

    public function showAllinLanguage($id, Request $request)
    {
        $items = Item::where('language_id','=',$id)->paginate(10);
        $categories = HomeController::showCategories();
        $languages = HomeController::showLanguages();
        return view('home',['categories'=>$categories,'languages'=>$languages,'items'=>$items,'remove'=>false]);
    }

    
}
