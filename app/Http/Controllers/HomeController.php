<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $view = [
            "titlePage" => "Home",
        ];
        return view('home',$view);
    }
}
