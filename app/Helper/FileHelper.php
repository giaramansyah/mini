<?php

namespace App\Helper;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class FileHelper
{
    public static function generatePath(String $disk, String $filename)
    {
        $datetime = Carbon::now();
        $year = $datetime->year;
        $month = $datetime->month < 10 ? '0' . $datetime->month : $datetime->month;
        $date = $datetime->day;
        $timestamp = $datetime->format('His');
        $storage = storage_path($disk);

        if (!File::exists($storage . '/' . $year)) {
            File::makeDirectory($storage . '/' . $year, 0755, true, true);
        }

        if (!File::exists($storage . '/' . $year . '/' . $month)) {
            File::makeDirectory($storage . '/' . $year . '/' . $month, 0755, true, true);
        }

        $filename = $date . '_' . $timestamp . '_' . $filename;

        return $storage . '/' . $year . '/' . $month . '/' . $filename;
    }
}
