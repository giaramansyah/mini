<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index() {
        return view('contents.home.index');
    }

    public function post(Request $request)
    {
        dd($request->all());
    }
}
