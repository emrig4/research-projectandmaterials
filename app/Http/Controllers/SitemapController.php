<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use Psr\Http\Message\UriInterface;
use Illuminate\Routing\Controller;
use Spatie\Sitemap\Tags\Url;
use Modules\Ebook\Entities\Ebook;
use Spatie\Sitemap\Sitemap;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $sitemapPath = public_path('sitemap.xml');
        SitemapGenerator::create(env('APP_URL'))
            ->shouldCrawl(function (UriInterface $url) {
           // All pages will be crawled, except the contact page.
           // Links present on the contact page won't be added to the
           // sitemap unless they are present on a crawlable page.
           
            if (preg_match('%\b(admin|users|storage)\b%i', $url->getPath()) > 0) {
                return false;
            }

            return true;
        })
        ->writeToFile($sitemapPath);

        return redirect()->back()->withSuccess(trans('admin::messages.update_message', ['resource' => 'Sitemap']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
