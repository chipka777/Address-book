<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Addres;

class MainController extends Controller
{
    public function index()
    {
        $data = Addres::latest()->get()->all();
        
        return view('main', compact('data'));
    }

}
