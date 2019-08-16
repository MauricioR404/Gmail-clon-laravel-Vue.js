<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\Requests\MessageStoreRequest;

class MessageController extends Controller
{
    
    public function store(MessageStoreRequest $request)
    {
         Message::create($request->all());

         return back()->withMessage('Se ha enviado el mensaje correctamente');
    }
}
