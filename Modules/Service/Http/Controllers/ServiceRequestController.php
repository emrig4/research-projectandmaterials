<?php

namespace Modules\Service\Http\Controllers;
use Modules\Service\Http\Requests\StoreServiceRequestRequest;
use Modules\Service\Entities\ServiceRequest;
use Modules\Service\Events\ServiceRequestedEvent;
use Illuminate\Support\Facades\Mail;
use Modules\Service\Mail\serviceRequestedMail;

class ServiceRequestController
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequestRequest $request)
    {
    	$data = $request->validated();
    	$data['status'] = 'pending';
    	$request = ServiceRequest::create($data);

    	// fire service requested event
        // Mail::to($request->contact_email)->send(new serviceRequestedMail($request));
        event(new ServiceRequestedEvent ($request));
       	return redirect()->back()->with('success', 'Request sent successfully, kindly check your mail');
    }
}
