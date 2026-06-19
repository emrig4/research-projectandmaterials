<?php

namespace Themes\Cynoebook\Http\ViewComposers;

use Illuminate\Support\Facades\DB;
use Modules\Ebook\Entities\Ebook;
use Modules\Testimonial\Entities\Testimonial;


class TestimonialComposer
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
            'testimonials' => $this->getTestimonials(),
        ]);
    }

    // airon
    private function getTestimonials()
    {
        $testimonials = Testimonial::where('is_enabled', true)->get();  
        return ($testimonials);

    }

}
