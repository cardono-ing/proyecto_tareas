<?php
namespace App\Controllers;

class Home extends BaseController
{
   public function index()
{
    service('request')->setLocale(session()->get('lang') ?? 'es');
    return view('home');
}

    public function lang($lang)
    {
        if (in_array($lang, ['en', 'es'])) {
            session()->set('lang', $lang);
        }
        return redirect()->back();
    }
}
