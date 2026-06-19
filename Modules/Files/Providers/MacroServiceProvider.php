<?php

namespace Modules\Files\Providers;

use Aws\S3\S3Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        File::macro('streamUpload', function($path, $fileName, $file, $overWrite = true, $visibility = 'private') {
            // Set up S3 connection.
            $resource = fopen($file->getRealPath(), 'r+');
            $config = Config::get('filesystems.disks.s3');
            $client = new S3Client([
                'credentials' => [
                    'key'    => $config['key'],
                    'secret' => $config['secret'],
                ],
                'region' => $config['region'],
                'version' => 'latest',
                'visibility' => $visibility,
            ]);

            $adapter = new AwsS3Adapter($client, $config['bucket'], $path);
            $filesystem = new Filesystem($adapter);

            if($overWrite){
                $filesystem->putStream($fileName, $resource, [ 'visibility' => $visibility]);
                return $path .'/'. $fileName;
            }else{
               $filesystem->writeStream($fileName, $resource, [ 'visibility' => $visibility]);
               return $path;
            }

            // return $overWrite 
            //         ? $filesystem->putStream($fileName, $resource) 
            //         : $filesystem->writeStream($fileName, $resource);
        });
    }
}
