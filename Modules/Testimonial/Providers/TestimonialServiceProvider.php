<?php

namespace Modules\Testimonial\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Base\Traits\AddsAsset;


class TestimonialServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addAdminAssets('admin.testimonials.create', ['admin.category.css', 'admin.jstree.js', 'admin.category.js', 'admin.files.css', 'admin.files.js']);


         $this->addAdminAssets('admin.testimonials.edit', ['admin.category.css', 'admin.jstree.js', 'admin.category.js', 'admin.files.css', 'admin.files.js']);
        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
