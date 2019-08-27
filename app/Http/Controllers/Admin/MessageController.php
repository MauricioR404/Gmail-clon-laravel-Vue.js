<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessagesResource;
use App\Message;

class MessageController extends Controller
{
    public function index()
    {   
        return MessagesResource::collection(
            Message::latest()->paginate(10)
        );
    }
}
