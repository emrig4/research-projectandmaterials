<?php

namespace Modules\Ebook\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Ebook\Entities\Ebook;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Ebook\Http\Requests\SaveEbookRequest;
use Illuminate\Http\Request;


class EbookController extends Controller
{
   use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Ebook::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'ebook::ebooks.ebook';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'ebook::admin.ebooks';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveEbookRequest::class;


        /**
     * Store a newly created resource in storage.
     *
     * @param \Modules\Ebook\Http\Requests\StoreEbookRequest $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
        // $user_id=auth()->user()->id;
        // if (setting('auto_approve_ebook') && setting('auto_approve_user')) {
        //    $is_active=1;
        // }else{
        //     $is_active=0;
        // }
       
        // $data=[
        //     'title'=>$request->title,
        //     'description'=>strip_tags($request->description),
        //     'short_description'=>strip_tags($request->short_description),
        //     'publication_year'=>$request->publication_year,
        //     'publisher'=>$request->publisher,
        //     'price'=>$request->price,
        //     'buy_url'=>$request->buy_url,
        //     'isbn'=>$request->isbn,
        //     'file_type'=>$request->file_type,
        //     'file_url'=>$request->file_url,
        //     'embed_code'=>$request->embed_code,
        //     'categories'=>$request->categories,
        //     'is_private'=>$request->is_private,
        //     'is_active'=>$is_active,
        //     'password'=>$request->password_protected,
        //     'user_id'=>$user_id,
        //     'is_featured'=>0,
        // ];
        
        // $ebook=Ebook::create($data);
        // if($request->hasFile('cover_image'))
        // {
        //     $file_image = $request->file('book_cover');
        //     $path_image = Storage::putFile('media', $file_image);
        //     $book_cover=Files::create([
        //         'user_id' => $user_id,
        //         'disk' => config('filesystems.default'),
        //         'filename' => $file_image->getClientOriginalName(),
        //         'path' => $path_image,
        //         'extension' => $file_image->guessClientExtension() ?? '',
        //         'mime' => $file_image->getClientMimeType(),
        //         'size' => $file_image->getClientSize(),
        //     ]);
        //     DB::table('entity_files')->insert([
        //         'files_id' => $book_cover->id,
        //         'entity_type'=>'Modules\Ebook\Entities\Ebook',
        //         'entity_id'=>$ebook->id,
        //         'zone'=>'book_cover',
        //         'created_at'=>$book_cover->created_at,
        //         'updated_at'=>$book_cover->updated_at,
        //     ]);
        // }
        // if($request->hasFile('book_file'))
        // {
        //     $file_pdf = $request->file('book_file');
        //     $path_pdf = Storage::putFile('media', $file_pdf);
        //     $book_file=Files::create([
        //         'user_id' => $user_id,
        //         'disk' => config('filesystems.default'),
        //         'filename' => $file_pdf->getClientOriginalName(),
        //         'path' => $path_pdf,
        //         'extension' => $file_pdf->guessClientExtension() ?? '',
        //         'mime' => $file_pdf->getClientMimeType(),
        //         'size' => $file_pdf->getClientSize(),
        //     ]);
        //     DB::table('entity_files')->insert([
        //         'files_id' => $book_file->id,
        //         'entity_type'=>'Modules\Ebook\Entities\Ebook',
        //         'entity_id'=>$ebook->id,
        //         'zone'=>'book_file',
        //         'created_at'=>$book_file->created_at,
        //         'updated_at'=>$book_file->updated_at,
        //     ]);
        // }

        // if($request->exists('cover_image'))
        // {
        //     // $file_pdf = $request->file('main_book_file');
            // $path_pdf = Storage::putFile('books', $file_pdf);
            // $main_book_file=Files::create([
            //     'user_id' => $user_id,
            //     'disk' => config('filesystems.default'),
            //     'filename' => $file_pdf->getClientOriginalName(),
            //     'path' => $path_pdf,
            //     'extension' => $file_pdf->guessClientExtension() ?? '',
            //     'mime' => $file_pdf->getClientMimeType(),
            //     'size' => $file_pdf->getClientSize(),
            // ]);
            // DB::table('entity_files')->insert([
            //     'files_id' => $main_book_file->id,
            //     'entity_type'=>'Modules\Ebook\Entities\Ebook',
            //     'entity_id'=>$ebook->id,
            //     'zone'=>'main_book_file',
            //     'created_at'=>$main_book_file->created_at,
            //     'updated_at'=>$main_book_file->updated_at,
            // ]);
            // $test =  "sslkflds";
        // }





        // if($request->hasFile('audio_book_files'))
        // {
        //     $audioFiles = $request->file('audio_book_files');
        //     foreach($audioFiles as $afile){
                
        //         $path_audio = Storage::putFile('media', $afile);
        //         $book_file=Files::create([
        //             'user_id' => $user_id,
        //             'disk' => config('filesystems.default'),
        //             'filename' => $afile->getClientOriginalName(),
        //             'path' => $path_audio,
        //             'extension' => $afile->guessClientExtension() ?? '',
        //             'mime' => $afile->getClientMimeType(),
        //             'size' => $afile->getClientSize(),
        //         ]);
        //         DB::table('entity_files')->insert([
        //             'files_id' => $book_file->id,
        //             'entity_type'=>'Modules\Ebook\Entities\Ebook',
        //             'entity_id'=>$ebook->id,
        //             'zone'=>'audio_book_files',
        //             'created_at'=>$book_file->created_at,
        //             'updated_at'=>$book_file->updated_at,
        //         ]);
        //     }
        // }
       
        // return back()->withSuccess(clean(trans('cynoebook::ebook.upload_success')));
        // dd($request);
    // }

        // public function store(Request $request){
        //     dd($request);
        // }

     // public function update($id){
     //    dd(request());
     // }

}
