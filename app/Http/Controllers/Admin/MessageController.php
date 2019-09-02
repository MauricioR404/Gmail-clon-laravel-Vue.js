<?php

namespace App\Http\Controllers\Admin;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessagesResource;

class MessageController extends Controller
{
    public function index()
    {   
        return MessagesResource::collection(
            Message::latest()->paginate(10)
        );
    }

    public function show(Message $message)
    {
        return $message;
    }

    public function destroy(Message $message)
    {
        $message->delete();
    }

    public function update(Message $message, Request $update)
    {
        return $message->updateMessage($update);
    }
}
