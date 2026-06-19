<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psr\Http\Message\UriInterface;
use Illuminate\Routing\Controller;
use Modules\Files\Entities\Files;
use Airondev\pCloud\File as pCloudFile;




class PCloudLinksGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pcloud:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new file urls for pcloud files';

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
     
        $files = Files::whereNotNull('pcloud_fileid')->get();
        $files->each(function ($item){
            $item->update(['pcloud_filelink'=> $this->getLinks( $item->pcloud_fileid ) ]);
        });
    }

    public function getLinks ($pcloudFileId){
        $pCloudFile = new  pCloudFile();
        $fileLink =  $pCloudFile->getPublicLink($pcloudFileId);

        return  $fileLink;
    }
}
