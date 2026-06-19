<?php

namespace Themes\Cynoebook\Http\ViewComposers;

use Modules\Service\Entities\Service;



class FeaturedServicesComposer
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
            'featuredServices' => $this->featuredServices(),
        ]);
    }

    // airon
    private function featuredServices()
    {
        return $featuredServices = Service::where('is_featured', true)->limit(6)->get();
    }

}
