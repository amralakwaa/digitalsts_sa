<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(string $locale)
    {
        if (in_array($locale, ['ar', 'en'])) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }

        return redirect()->back();
    }
}
