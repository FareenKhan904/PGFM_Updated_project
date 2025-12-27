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
            try {
                $news = News::where('is_published', true)
                    ->latest()
                    ->take(10)
                    ->get();
                $view->with('news', $news);
            } catch (\Illuminate\Database\QueryException $e) {
                // Database connection failed - use empty collection
                \Log::warning('Database connection failed in AppServiceProvider: ' . $e->getMessage());
                $view->with('news', collect());
            } catch (\Exception $e) {
                // Any other exception - use empty collection
                \Log::warning('Error loading news in AppServiceProvider: ' . $e->getMessage());
                $view->with('news', collect());
            }
        });
    }
}
