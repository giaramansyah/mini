<?php

namespace App\Helper;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;

class LanguageHelper
{
    public static function get()
    {
        $languages = array_combine(config('global.languages.code'), config('global.languages.desc'));
        $result = [];
        foreach ($languages as $code => $desc) {
            $result[] = [
                'code' => $code,
                'label' => Str::upper($code),
                'title' => $desc,
                'active' => App::getLocale() == $code ? 'active' : ''
            ];
        }

        return $result;
    }
}
