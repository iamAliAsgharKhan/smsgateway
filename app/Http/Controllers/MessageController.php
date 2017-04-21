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
            ->with('user')
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
            'status' => true,
            'message' => $message
        ]);
    }

    public function viewReply()
    {
        $message = Message::whereId(request('id'))
            ->whereType('inbox')
            ->first();

        if (empty($message)) {
            return response()->json(['status' => false], 404);
        }

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function reply(MessageRequest $request)
    {
        // find old message
        $message = Message::whereId($request->messageId)->first();

        $reply = Message::create([
            'user_id' => Auth::id(),
            'sender' => '',
            'receipent' => $message->sender,
            'message_id' => $request->messageId,
            'content' => $request->content,
            'type' => 'outbox'
        ]);

        return response()->json([
            'status' => true,
            'message' => $reply
        ]);
    }
}
