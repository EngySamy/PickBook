<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AboutusController extends Controller
{
    //
    public function index()
    {
    	return view('aboutus');
    }
}
