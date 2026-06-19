<?php

namespace Modules\Faq\Http\Controllers\Admin;

use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Modules\Faq\Entities\FaqCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of faq_category.
     *
     * @return Response
     */
    public function index()
    {
        return view('faq::admin.categories.index')->with('categories', FaqCategory::all());

    }

    /**
     * Show the form for creating a new faq_category.
     *
     * @return Response
     */
    public function create()
    {
        // return view('faq.categories.create_edit');
    }

    /**
     * Store a newly created faq_category in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, FaqCategory::$rules);
        $category = FaqCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('status', 'Category created successfully');
    }

    /**
     * Display the specified faq_category.
     *
     * @param FaqCategory $category
     * @return Response
     */
    public function show(FaqCategory $category)
    {
        // return view('faq..categories.show')->with('item', $category);
        return response()->json(['category' => $category, 'category' => $category]);
    }

    /**
     * Show the form for editing the specified faq_category.
     *
     * @param FaqCategory $category
     * @return Response
     */
    public function edit(FaqCategory $category)
    {
        return view('faq.categories.create_edit')->with('item', $category);
    }

    /**
     * Update the specified faq_category in storage.
     *
     * @param FaqCategory $category
     * @param Request     $request
     * @return Response
     */
    public function update(FaqCategory $category, Request $request)
    {
        $category->update($request->only('name'));
        return response()->json($request); 
    }

    /**
     * Remove the specified faq_category from storage.
     *
     * @param FaqCategory $category
     * @param Request     $request
     * @return Response
     */
    public function destroy(FaqCategory $category, Request $request)
    {
        $category->delete();
        return response()->json(['status', 'FAQ deleted successfully'], 201);
    }
}
