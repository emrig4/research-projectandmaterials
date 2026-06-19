<?php 
namespace App\Providers;

use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Airondev\pCloud\App;
use Airondev\pCloud\File;
use Airondev\pCloud\PcloudAdapter;

class PcloudServiceProvider extends ServiceProvider {

    public function boot()
    {
        Storage::extend('pcloud', function($app, $config)
        {
            // $client = new PcloudAdapter();
            // return new Filesystem($client);

            $client = new File();
            return new Filesystem(new PcloudAdapter($client));
        });
    }

    public function register()
    {
        //
    }

}