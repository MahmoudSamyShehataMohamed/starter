<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class SecondController extends Controller
{


public function __construct()
{
$this->middleware('auth')->except('showString2');
}

    public function showString1()
    {
        return "showString1";
    }
    public function showString2()
    {
        return "showString2";
    }
    public function showString3()
    {
        return "showString3";
    }
    public function showString4()
    {
        return "";
    }
}
