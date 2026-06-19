<?php

namespace Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Contact\Http\Requests\ContactRequest;
use Modules\Contact\Mail\contactMail;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('public.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        try {
            // Mail::raw($request->message, function (Message $message) use ($request) {
            // $message->subject('Contact Us - '.$request->subject)
            //     // ->from($request->email,$request->first_name." ".$request->last_name)
            //     ->to(setting('site_email'));
            // });

            Mail::to(setting('site_email'))
             ->cc([setting('contact_email')])
             ->send(new contactMail($request));

            return back()->with('success', clean(trans('cynoebook::contact.your_message_has_been_sent')));
        } catch (Exception $e) {
            dd($e);
        }
    }
}
