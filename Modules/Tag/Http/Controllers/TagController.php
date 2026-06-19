<?php

namespace Modules\Tag\Http\Controllers;

use Illuminate\Routing\Controller;
use Conner\Tagging\Model\Tag;


class TagController extends Controller
{



     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('count', 'DESC')->paginate(24);
        return view('public.tags.index', compact('tags'));
    }
    

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::withoutGlobalScope('active')->find($id);
    }

}
