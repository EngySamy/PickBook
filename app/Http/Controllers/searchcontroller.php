<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\ArtSchool;
use App\ColorType;
use App\Item;

class searchcontroller extends Controller
{
    public function search()
{
   $keyword=\Request::get('keyword');
   $keyword=trim($keyword);
   $items= item::where('name','like','%'.$keyword.'%')
   ->orderby ('name')
   ->paginate(5);
    $artschools = searchcontroller::showArtSchools();
        $colors = searchcontroller::showColorTypes();
        
    return view('home',['artschools'=>$artschools,'colors'=>$colors,'items'=>$items]);

   	}
   	public function showArtSchools()
    {
        return ArtSchool::orderBy('name')->get();        //Sort ascendingly
    }

    public function showColorTypes()
    {
        return ColorType::orderBy('name')->get();
    }


     }	