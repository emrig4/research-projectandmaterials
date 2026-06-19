<?php

namespace Themes\Cynoebook\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Base\Traits\AddsAsset;
use Modules\Admin\Ui\Facades\TabManager;
use Themes\Cynoebook\Admin\CynoebookTabs;
use Themes\Cynoebook\Http\ViewComposers\LayoutComposer;
use Themes\Cynoebook\Http\ViewComposers\HomePageComposer;
use Themes\Cynoebook\Http\ViewComposers\EbooksFilterComposer;
use Themes\Cynoebook\Http\ViewComposers\TopCategoriesWidgetComposer;
use Themes\Cynoebook\Http\ViewComposers\TestimonialComposer;
use Themes\Cynoebook\Http\ViewComposers\FeaturedServicesComposer;

class CynoebookServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('cynoebook', CynoebookTabs::class);

        View::composer('public.layout', LayoutComposer::class);
        View::composer('public.home.index', HomePageComposer::class);
        View::composer('public.ebooks.partials.filter', EbooksFilterComposer::class);
        View::composer('public.include.search_ebook', EbooksFilterComposer::class);

        View::composer('public.include.widgets.top-categories_widget', TopCategoriesWidgetComposer::class);

        View::composer('public.testimonials.partials.mega_slider', TestimonialComposer::class);
        View::composer('public.services.partials.featured', FeaturedServicesComposer::class);


        $this->addAdminAssets('admin.cynoebook.settings.edit', [
            'admin.cynoebook.css', 'admin.files.css', 'admin.cynoebook.js', 'admin.files.js',
        ]);
    }
}
