<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestController extends Controller
{

    public function welcome()
    {
        $data=[];
        $data=['name d','mahmouddd'];
        return view('welcome',compact('data'));
    }


    public function landing()
    {
        return view('landing');
    }

    public function about()
    {
        return view('about');
    }
}
