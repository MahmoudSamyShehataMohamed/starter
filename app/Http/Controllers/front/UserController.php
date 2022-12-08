<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class UserController extends Controller
{
    public function showAdminName()
    {
        return "mahmoud samy";
    }

    public function para($param)
    {
        return $param;
    }

    public function getIndex(){
        return view('welcome');
    }
}
