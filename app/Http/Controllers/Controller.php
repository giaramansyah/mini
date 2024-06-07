<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function hasPrivilege($code)
    {
        if (!in_array($code, session('privileges'))) {
            return false;
        }
        return true;
    }

    public function numberFormat($value, $inverted = false)
    {
        if ($inverted) {
            return preg_replace("/[^0-9.]/", "", $value);
        } else {
            return number_format($value, 0, null, ',');
        }
    }

    public function pathUpload()
    {
        $monthArr = array_combine(config('global.month.code'), config('global.month.static'));
        $today = Carbon::now();
        $year = $today->year;
        $month = $today->month;
        $month = $month < 10 ? '0' . $month : $month;

        $path = Storage::disk('upload')->path('') . $year;
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $path = Storage::disk('upload')->path('') . $year . '/' . $monthArr[$month];
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
