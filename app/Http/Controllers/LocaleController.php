<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function index($id)
    {
        App::setlocale($id);
        Session::put('locale', $id);
        return redirect()->back();
    }

    public function datatables()
    {
        return response()->json(Lang::get('datatables'));
    }
}
