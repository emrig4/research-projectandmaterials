<?php

namespace Modules\Service\Http\Controllers;
use Modules\Newsletter\Http\Requests\StoreServiceRequest;
use Modules\Service\Entities\Service;

class ServiceController
{
    public function index()
    {
       $services = Service::where('is_active', true)->paginate(21);

       return view('public.services.index', compact('services') );
    }

    public function show($slug)
    {
       $service = Service::where(['slug' => $slug, 'is_active' => true])->firstOrFail();
       return view('public.services.single', ['service' => $service] );
    }
}
