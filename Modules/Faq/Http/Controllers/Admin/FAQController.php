<?php

namespace Modules\Faq\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Faq\Entities\FAQ;
use Modules\Faq\Entities\FaqCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class FAQController extends Controller
{
    /**
     * Display a listing of faq.
     *
     * @return Response
     */
    public function index()
    {
        $faqs = FAQ::with('category')->paginate(10);
        $categories = FaqCategory::all();
        return view('faq::admin.index')->with(['faqs' => $faqs, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new faq.
     *
     * @return Response
     */
    public function create()
    {
        $categories = FaqCategory::all();

        return view('faq::admin.create_edit')->with('categories', $categories);
    }

    /**
     * Store a newly created faq in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, FAQ::$rules);
        FAQ::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'slug' => Str::slug($request->question),
            'category_id' => $request->category_id
        ]);

        return redirect()->back()->with('status', 'Created successfully');
    }

    /**
     * Display the specified faq.
     *
     * @param FAQ $faq
     * @return Response
     */
    public function show(FAQ $faq)
    {
        $category = $faq->category;
        return response()->json(['category' => $category, 'faq' => $faq]);
    }

    /**
     * Show the form for editing the specified faq.
     *
     * @param FAQ $faq
     * @return Response
     */
    public function edit(FAQ $faq)
    {
        return response()->json($faq);
    }

    /**
     * Update the specified faq in storage.
     *
     * @param FAQ     $faq
     * @param Request $request
     * @return Response
     */
    public function update(FAQ $faq, Request $request)
    {
        $faq->update($request->only('question', 'answer', 'category_id'));
        return response()->json($request);
    }

    /**
     * Remove the specified faq from storage.
     *
     * @param FAQ     $faq
     * @param Request $request
     * @return Response
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return response()->json(['status', 'FAQ deleted successfully'], 201);
    }
}
