<?php

namespace App\Http\Controllers;

use Auth;
use App\SMSGateway\Message;
use App\Http\Requests\SMSGateway\MessageRequest;

class MessageController extends Controller
{
    public function paginate()
    {
        abort_if(! request()->ajax(), 404, 'Page not found.');

        $messages = Message::orderBy('created_at', 'DESC')
            ->paginate(request('limit', 20));

        return response()->json($messages);
    }

    public function send(MessageRequest $request)
    {
        $message = Message::create([
            'user_id' => Auth::id(),
            'sender' => '',
            'receipent' => $request->receipent,
            'content' => $request->content,
            'type' => 'outbox',
            'status' => 'sent'
        ]);

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}
