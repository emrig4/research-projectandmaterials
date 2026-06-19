<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use Spatie\Sitemap\SitemapGenerator;
use Modules\Setting\Http\Controllers\Admin\SitemapController;
use Psr\Http\Message\UriInterface;
use Illuminate\Routing\Controller;
use Spatie\Sitemap\Tags\Url;
use Modules\Ebook\Entities\Ebook;
use Spatie\Sitemap\Sitemap;



class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Sitemap for site';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $sitemapPath = public_path('sitemap.xml');
        // SitemapGenerator::create(env('APP_URL'))
        //     ->shouldCrawl(function (UriInterface $url) {
        //    // All pages will be crawled, except the contact page.
        //    // Links present on the contact page won't be added to the
        //    // sitemap unless they are present on a crawlable page.
           
        //     if (preg_match('%\b(admin|users|storage)\b%i', $url->getPath()) > 0) {
        //         return false;
        //     }
        //     return true;
        // })
        // ->writeToFile($sitemapPath);

        return SitemapController::generate();
    }
}
