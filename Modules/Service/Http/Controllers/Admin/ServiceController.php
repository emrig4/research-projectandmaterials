<?php

namespace Modules\Service\Http\Controllers\Admin;
use Modules\Service\Http\Requests\StoreServiceRequest;
use Modules\Service\Http\Requests\UpdateServiceRequest;
use Illuminate\Routing\Controller;
use Modules\Service\Entities\Service;
use Illuminate\Http\Request;
use Modules\Ebook\Entities\Currency;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class ServiceController extends Controller
{
  	public function index()
    {
    	$services = Service::paginate(20);
       	return view('service::admin.services.index',  ['services' => $services]);
    }

    public function create()
    {
    	$currencies = Currency::select('code', 'id')->get();
       	return view('service::admin.services.create', ['currencies' => $currencies]);
    }

    public function store(StoreServiceRequest $request)
    {
    	$validated = Validator::make($request->all(), [
    		'slug' => ['unique:services']
    	]);

    	if( $validated->fails() ){
    		return redirect()->back()->with('error', 'Service with same name already exists' );
    	}

    	$service = Service::create($request->all());
    	return redirect()->back()->with('success', 'Service created successfully' );

    }


    public function edit($id)
    {	
    	$currencies = Currency::select('code', 'id')->get();
    	$service = Service::find($id);
       	return view('service::admin.services.edit',  ['service' => $service, 'currencies' => $currencies]);
    }

     public function update($id, UpdateServiceRequest $request)
    {	
    	$service = Service::find($id);
    	$service->update($request->all());
       	return redirect()->back()->with('success', 'Service updated successfully' );
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $service->forceDelete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully' );

    }
}
