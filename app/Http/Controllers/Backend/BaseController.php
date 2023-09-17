<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class BaseController extends Controller
{
    public function __construct()
    {
        view()->composer('backend.*',function($view){
            $settings = Setting::get()->pluck('value','key')->toArray();
            $view->with([
                    'siteLocales'=> config('translatable.languages'),
                    'settings'=>$settings
                ]);
        });
    }
}
