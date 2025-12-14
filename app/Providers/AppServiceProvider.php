<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Helpers\SiteHelper;

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
        // Share site settings with all views
        View::composer('*', function ($view) {
            $view->with([
                'siteSettings' => [
                    'company' => SiteHelper::getCompanyInfo(),
                    'contact' => SiteHelper::getContactInfo(),
                    'social' => SiteHelper::getSocialLinks(),
                    'footer' => SiteHelper::getFooterSettings(),
                    'buttons' => SiteHelper::getButtonTexts(),
                    'seo' => SiteHelper::getSeoSettings(),
                ]
            ]);
        });
    }
}
