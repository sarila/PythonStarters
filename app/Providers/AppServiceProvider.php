<?php

namespace App\Providers;
use App\Models\Theme;
use App\Models\Poster;
use App\Models\Social;
use App\Models\Companyinfo;
use Illuminate\Support\Facades\View;
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
        View::composer(['admin.*'], function($view){
            $view->with('theme', Theme::first());
        });
        View::composer(['front.*'], function($view){
            $view->with('theme', Theme::first());
        });
        View::composer(['emails.*'], function($view){
            $view->with('theme', Theme::first());
        });
        View::composer(['front.*'], function($view){
            $view->with('social', Social::first());
        });
        View::composer(['front.includes.header'], function($view){
            $view->with('header_poster', Poster::where('placement', 0)->first());
        });
        View::composer(['front.includes.footer'], function($view){
            $view->with('companyinfo', Companyinfo::first());
        });
        View::composer(['front.includes.sidebar'], function($view){
            $view->with('sidebar_poster', Poster::where('placement', 2)->first());
        });

        View::composer(['front.*'], function($view){
            $view->with('index_banner_poster', Poster::where('placement', 1)->latest()->take(2)->get());
        });

        View::composer(['front.*'], function($view){
            $view->with('index_square_poster', Poster::where('placement', 4)->latest()->take(2)->get());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
