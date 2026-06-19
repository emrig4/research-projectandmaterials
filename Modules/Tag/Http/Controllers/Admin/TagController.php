<?php

namespace Modules\Tag\Http\Controllers\Admin;
use Illuminate\Routing\Controller;
use Modules\Service\Entities\Service;
use Illuminate\Http\Request;
use Conner\Tagging\Model\Tag;
use Modules\Ebook\Entities\Ebook;



class TagController extends Controller
{
  	public function index()
    {
        $tags = Tag::paginate(20);
       	return view('tag::admin.tags.index',  ['tags' => $tags]);
    }

    public function create()
    {
    	$currencies = Currency::select('code', 'id')->get();
       	return view('service::admin.services.create', ['currencies' => $currencies]);
    }


    public function destroy($slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        // untag all ebooks with that tag before deleting tag
        $ebooks = Ebook::withAllTags($slug)->get();
        $ebooks->each->untag($slug);
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted successfully' );

    }
}
