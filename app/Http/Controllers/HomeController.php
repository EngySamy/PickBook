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
use App\SellRequest;
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
        $artschools = HomeController::showArtSchools();
        $colors = HomeController::showColorTypes();
        return view('home',['artschools'=>$artschools,'colors'=>$colors,'items'=>$items]);
    }

    public function showArtSchools()
    {
        return Category::orderBy('name')->get();        //Sort ascendingly
    }

    public function showColorTypes()
    {
        return Language::orderBy('name')->get();
    }

    public function showAllinArtSchool($id,Request $request)
    {
        $items = Item::where('artschool_id','=',$id)->paginate(10);
        $artschools = HomeController::showArtSchools();
        $colors = HomeController::showColorTypes();
        return view('home',['artschools'=>$artschools,'colors'=>$colors,'items'=>$items]);
    }

    public function showAllinColor($id,Request $request)
    {
        $items = Item::where('colortype_id','=',$id)->paginate(10);
        $artschools = HomeController::showArtSchools();
        $colors = HomeController::showColorTypes();
        return view('home',['artschools'=>$artschools,'colors'=>$colors,'items'=>$items]);
    }

    
}
