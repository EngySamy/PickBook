<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Category;
use App\Language;
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
        $categories = searchcontroller::showCategories();
            $languages = searchcontroller::showLanguages();

        return view('home',['categories'=>$categories,'languages'=>$languages,'items'=>$items , 'remove'=>false]);

   	}
   	public function showCategories()
    {
        return Category::orderBy('name')->get();        //Sort ascendingly
    }

    public function showLanguages()
    {
        return Language::orderBy('name')->get();
    }


}