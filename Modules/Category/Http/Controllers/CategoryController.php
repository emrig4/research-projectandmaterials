<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{



    public function index()
    {
        $categories = Category::orderBy('slug', 'ASC')->paginate(24);
        return view('public.categories.index', compact('categories'));
    }


    public function listDepartments()
    {
        $departments = $this->getTopCategories();
        return view('public.departments.index', compact('departments'));
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


     private function getTopCategories()
    {
        $cat = \DB::table('categories')
            ->join('ebook_categories', 'ebook_categories.category_id',  '=', 'categories.id')
            ->join('category_translations', 'category_translations.category_id',  '=', 'categories.id')
            ->select('categories.slug', 'category_translations.name', DB::raw("count(ebook_categories.category_id) as count"))
            ->groupBy(['categories.slug', 'categories.description', 'category_translations.name'])
            ->orderBy('count', 'DESC')
            // ->limit(20)
            ->get();
            
        return ($cat );

    }

}
