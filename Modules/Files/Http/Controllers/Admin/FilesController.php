<?php

namespace Modules\Files\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Files\Entities\Files;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Files\Http\Requests\UploadFilesRequest;
use Modules\Admin\Ui\AdminTable;
use Modules\Files\Admin\Table\FilesTable;
use Airondev\pCloud\File as pCloudFile;
use Airondev\pCloud\Folder as pCloudFolder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Controllers\Optimizer;




class FilesController extends Controller
{
    use HasDefaultActions;
    
    protected $model = Files::class;
    
    protected $label = 'files::files.files';
    
    protected $viewPath = 'files::admin.files';
    
    //protected $validation = UpdateFilesRequest::class;
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filesManager()
    {
        $type = request('type');
        $extension = request('extension');
        return view('files::admin.files.manager', compact('type','extension'));
    }
    
    public function store(UploadFilesRequest $request)
    {
        //$request->merge(clean($request->all()));
        $file = $request->file('file');

        if(setting('storage_location') === 'pcloud'){
            return $this->pcloudUpload($file);
        }elseif(setting('storage_location') === 's3'){
            return $this->s3Upload($file);
        }else{
            return $this->defaultUpload($file);
        } 
    }
    
    public function destroy($ids)
    {
        $delete_id=explode(',', $ids);
        foreach($delete_id as $id)
        {
            $entity=Files::findById($id);
            activity('file')
                ->performedOn($entity)
                ->causedBy(auth()->user())
                ->withProperties(['subject' => $entity,'causer'=>auth()->user()])
                ->log('deleted');
        }
        Files::find(explode(',', $ids))->each(function($file){
            $file->delete();
            Storage::delete('media/' . $file->filename);
        });
       
    }
    
    public function download($id)
    {
        $id=id_decode($id);
        $files = Files::where('id', $id)->firstOrFail();
       
        if($files)
        {
            $files->increment('download');
            
            activity('file')
                ->performedOn($files)
                ->causedBy(auth()->user())
                ->withProperties(['subject' => $files,'causer'=>auth()->user()])
                ->log('download');
            
            $headers = [
              'Content-Type' => $files->mime,
            ];

            if($files->pcloud_fileid){
                $path = $files->pcloud_filelink;
            }else{
                $path=$files->path;
            }


            $temp = tempnam(sys_get_temp_dir(), $files->filename);
            copy($path, $temp);
            return response()->download($temp, $files->filename, $headers);
        }else{
            return back();
        }
        
    }
    
    
    // airon here
    public function pcloudIndex(Request $request)
    { 
        $files = new Files();

        $vt = $files->table($request);
        $pCloudFile = new pCloudFile();
        $pCloudFolder = $pCloudFile->listFolder("/Public Folder");
        $pCloudFolderContent = $pCloudFolder->metadata->contents;

        if ($request->has('query')) {
            return $vt;
        }

        if ($request->has('table')) {
            return $vt;
        }

         return view('files::admin.files.pcloud');
    }


    public function defaultUpload($file) {
        $current = Carbon::now()->format('YmdHs');
        $fileExtension = $file->getClientOriginalExtension();

        // regular filename
        $nnn =str_replace( $fileExtension,  '.' .$fileExtension,  Str::slug($file->getClientOriginalName()) );
        $fileName = strtoupper($nnn);

        // unique filename with timestamp
        // $nnn =str_replace( $fileExtension, '-'.$current . '.' .$fileExtension,  Str::slug($file->getClientOriginalName()) );
        // $fileName = strtoupper($nnn);


        $path = Storage::putFileAs('media', $file, $fileName );



        $pathToImage = public_path('storage/' . $path);
        $img = new Optimizer();
        $img->optimize($pathToImage);


         
        $data=Files::create([
            'user_id' => auth()->id(),
            'disk' => config('filesystems.default'),
            'filename' => $fileName,
            'path' => $path,
            'extension' => $file->guessClientExtension() ?? '',
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
        
        activity('file')
                ->performedOn($data)
                ->causedBy(auth()->user())
                ->withProperties(['subject' => $data,'causer'=>auth()->user()])
                ->log('created');
        

        return response('Created', Response::HTTP_CREATED);
    }

    public function s3Upload($file) {

        $current = Carbon::now()->format('YmdHs');
        $fileExtension = $file->getClientOriginalExtension();

        // regular filename
        $nnn =str_replace( $fileExtension,  '.' .$fileExtension,  Str::slug($file->getClientOriginalName()) );
        $fileName = strtoupper($nnn);

        // unique filename with timestamp
        // $nnn =str_replace( $fileExtension, '-'.$current . '.' .$fileExtension,  Str::slug($file->getClientOriginalName()) );
        // $fileName = strtoupper($nnn);

        // streaming upload
        //  $path = Storage::disk('s3')->put($fileName, fopen($file->getRealPath(), 'r+') );

        // Streaming Upload to S3, overwriting if filename exists.
        // $path = File::streamUpload('media', $fileName, $file, true, 'public');

        // default S3 mode
        $path = Storage::disk('s3')->putFileAs('media', $file, $fileName, 'public' );

        $data=Files::create([
            'user_id' => auth()->id(),
            'disk' => config('filesystems.cloud'),
            // 'filename' => $file->getClientOriginalName(),
            'filename' => $fileName,
            'path' => $path,
            'extension' => $file->guessClientExtension() ?? '',
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
        
        activity('file')
                ->performedOn($data)
                ->causedBy(auth()->user())
                ->withProperties(['subject' => $data,'causer'=>auth()->user()])
                ->log('created');
        

        return response('Created', Response::HTTP_CREATED);
    }

    public function pcloudUpload($file)
    { 
        try {

            $current = Carbon::now()->format('YmdHs');
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = str_replace( '.'. $fileExtension, '-'.$current . '.' .$fileExtension,  $file->getClientOriginalName() );

            $path = Storage::putFileAs('media/pcloud', $file, $fileName );
            $fileLink = public_path('storage/' . $path);

            $pCloudFolder = new pCloudFolder();
            $folderId = $pCloudFolder->createIfNotExists("ProjectMaterials");

            $pCloudFile = new  pCloudFile();
            $pCloudUploadedFile = $pCloudFile->upload($fileLink, $folderId );

            $data= Files::create([
                'user_id' =>1,
                'disk' => config('filesystems.default'),
                'filename' => $pCloudUploadedFile->metadata->name,
                'path' => $pCloudUploadedFile->metadata->name,
                'extension' => $fileExtension,
                'mime' => $pCloudUploadedFile->metadata->contenttype,
                'size' => $pCloudUploadedFile->metadata->size,

                'pcloud_fileid' => $pCloudUploadedFile->metadata->fileid,
                'pcloud_folderid' => $pCloudUploadedFile->metadata->parentfolderid,
                'pcloud_filelink' => $pCloudFile->getPublicLink($pCloudUploadedFile->metadata->fileid),
                'pcloud_path' => $pCloudUploadedFile->metadata->name,
                'pcloud_contenttype' => $pCloudUploadedFile->metadata->contenttype,
            ]);

            activity('file')
                ->performedOn($data)
                ->causedBy(auth()->user())
                ->withProperties(['subject' => $data,'causer'=>auth()->user()])
                ->log('created');

            // delete temp files from local server
            $files = Storage::allFiles('media/pcloud');
            Storage::delete($files);
        
            return response('Created', Response::HTTP_CREATED);


        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
