<?php

namespace App\Observers;

use App\Conversation;
use App\Message;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        $conversation = Conversation::whereUserId($message->from_id)
            ->whereContactId($message->to_id)
            ->first();

        if ($conversation) {
            $conversation->last_message = "Tú: $message->content";
            $conversation->last_time = $message->created_at;
            $conversation->save();
        }

        $conversation = Conversation::whereUserId($message->to_id)
            ->whereContactId($message->from_id)
            ->first();

        if ($conversation) {
            $conversation->last_message = "$conversation->contact_name: $message->content";
            $conversation->last_time = $message->created_at;
            $conversation->save();
        }
    }
}
