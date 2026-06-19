<?php

namespace Themes\Cynoebook\Http\ViewComposers;

use Illuminate\Support\Facades\DB;
use Modules\Ebook\Entities\Ebook;
use Modules\Category\Entities\Category;


class TopCategoriesWidgetComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'categories' => $this->getTopCategories(),
        ]);
    }

    // airon
    private function getTopCategories()
    {
        $cat = \DB::table('categories')
            ->join('ebook_categories', 'ebook_categories.category_id',  '=', 'categories.id')
            ->join('category_translations', 'category_translations.category_id',  '=', 'categories.id')
            ->select('categories.slug', 'category_translations.name', DB::raw("count(ebook_categories.category_id) as count"))
            ->groupBy(['categories.slug', 'categories.description', 'category_translations.name'])
            ->orderBy('count', 'DESC')
            ->limit(20)
            ->get();
            
        return ($cat );

    }

}
