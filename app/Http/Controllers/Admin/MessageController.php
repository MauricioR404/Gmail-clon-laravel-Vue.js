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

    public function destroy(Message $message)
    {
        $message->delete();

        return 'Mensaje Eliminado';
    }
}
