<?php

namespace Modules\Faq\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Faq\Entities\FAQ;
use Modules\Faq\Entities\FaqCategory;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::all();
        $faqs = FaqCategory::with('faqs')->orderBy('name')->get();
        return view('public.faq.index')->with(['faqs' => $faqs, 'categories' => $categories]);
    }

    /**
     * Increments the total views
     * @param FAQ    $faq
     * @param string $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function incrementClick(FAQ $faq, $type = 'total_read')
    {
        if ($type == 'total_read' || $type == 'helpful_yes' || $type == 'helpful_no') {
            $faq->increment($type);
        }

        return response()->json(['status' => 'successfull'], 204);
    }
}