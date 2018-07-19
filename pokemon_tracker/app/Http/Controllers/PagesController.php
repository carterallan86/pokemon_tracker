<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'This is the home page';
        return view('pages.index')->with('title',$title);
    }


    public function tracking(){
        return view('pages.tracking');
    }

    public function shinyhunting(){
        return view('pages.shinyhunting');
    }
}

