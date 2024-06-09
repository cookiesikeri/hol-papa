<?php

namespace App\Providers;



use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {

            $view->with('site', \App\Models\PapaSiteSetting::first());
            $view->with('general', \App\Models\PapaGeneralDetail::first());
            // $view->with('states', \App\Models\State::orderBy('name')->get());
            $view->with('unreadm', \App\Models\PapaContactMessage::where('is_treated', 0)->where('status', 0)->orderBy('id', 'desc')->get());
            $view->with('unreadcount', \App\Models\PapaContactMessage::where('is_treated', 0)->where('status', 0)->count());
            $view->with('readmsgcount', \App\Models\PapaContactMessage::where('is_treated', 1)->where('status', 1)->count());
            $view->with('countries', \App\Models\Country::orderBy('title')->get());
            $view->with('sliders', \App\Models\PapaSlider::orderBy('position')->get());



        });
            if(App::environment() == "production")
        {
            $url = \Request::url();
            $check = strstr($url,"http://");
            if($check)
            {
               $newUrl = str_replace("http","https",$url);
               header("Location:".$newUrl);

            }
        }
        // {
        //     \URL::forceScheme('https');

        //     Paginator::useBootstrap();
        // }
}
}
