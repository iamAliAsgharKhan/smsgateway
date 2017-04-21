<?php

namespace App\Http\Controllers;

use App\SMSGateway\Message;
use App\SMSGateway\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function paginate()
    {
        // get contacts
        $contacts = Contact::orderBy('name', 'ASC')
            ->paginate(request('limit', 20));

        // filter data
        if (request()->all()) {
            $contacts->appends(request()->all());
        }

        // return response
        return response()->json($contacts);
    }

    public function store(ContactRequest $request)
    {
        $contact = \DB::transaction(function() use($request){
            // save new contact
            $contact = Contact::create($request->only(['name', 'number']));

            // update all contact in messages
            Message::where('receipent', $request->number)
                ->update(['contact_id' => $contact->id]);

            return $contact;
        });

        // return response
        return response()->json([
            'status' => true,
            'contact' => $contact
        ]);
    }
}
