<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'email', 'body', 'phone', 'state', 'category_id'];


    public static function listMessages($list)
    {
        switch ($list->category){
            case 'all':
                return static::latest()->paginate(10);
                break;
            case 'starred':
                return static::where('category_id', 1)->latest()->paginate(10);
                break;
            default : 
                return static::latest()->paginate(10);
                break;
            }
    }


    public function updateMessage($update)
    {
        switch ($update->update) {
            case 'readOrUnread':
                return $this->readOrUnread();
                break;
            case 'starred':
                return $this->starred();
                break;
        }
    }
    
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

    /** Verify that the category does not belong to anyone, and id assigned for the momment
     * " starred ", in the future there will be more categories and will have to change.
     */
    public function starred()
    {
        $starred = 0;

        if($this->category_id == 0){
            $starred = 1;
        }
        
        $this->update(['category_id' => $starred]);

        return $starred;
    }
}
