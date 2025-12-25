<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\News;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share news with all views for the news ticker
        View::composer('layouts.public', function ($view) {
            $news = News::where('is_published', true)
                ->latest()
                ->take(10)
                ->get();
            $view->with('news', $news);
        });
    }
}
