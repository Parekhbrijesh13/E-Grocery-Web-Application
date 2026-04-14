<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('Home.index');
    }

    public function contact(){
        return view('Home.contact');
    }

    public function about(){
        return view('Home.about');
    }
}
