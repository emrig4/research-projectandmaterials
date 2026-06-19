<?php

namespace Modules\Service\Http\Controllers\Admin;
use Modules\Service\Http\Requests\StoreServiceRequestRequest;
use Modules\Service\Http\Requests\UpdateServiceRequestRequest;
use Modules\Service\Entities\ServiceRequest;

class ServiceRequestController
{


	public function index()
    {
       $serviceRequests = ServiceRequest::paginate(20);
      	return view('service::admin.service_requests.index',  ['serviceRequests' => $serviceRequests]);
    }

    public function show($id)
    {
       $serviceRequest = ServiceRequest::find($id);
      	return view('service::admin.service_requests.show',  ['serviceRequest' => $serviceRequest]);
    }

    public function update($id, UpdateServiceRequestRequest $request)
    {
       $serviceRequest = ServiceRequest::find($id);
       $data = $request->validated();
       $serviceRequest->update($data);
       return redirect()->back()->with('success', 'Request settings updated successfully');
    }

    public function destroy($id)
    {
       $serviceRequest = ServiceRequest::find($id);
       $serviceRequest->forceDelete();
       return redirect()->route('admin.services.index')->with('success', 'Request settings deleted successfully');
    }
}
