<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'email', 'body', 'phone', 'state'];

    /** It is verified that the status of the message, to mark as read or unread */
    public function readOrUnread()
    {
        $state = 0;

        if($this->state == 0){
            $state = 1;
        }

        $this->update(['state' => $state]);

        return $state;
    }
}
