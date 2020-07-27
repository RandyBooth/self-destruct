<?php

namespace App\Observers;

use App\Message;
use Hidehalo\Nanoid\Client;
use Hidehalo\Nanoid\CoreInterface;

class MessageObserver
{
    /**
     * Handle the message "creating" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function creating(Message $message)
    {
        $alphabet = preg_replace('/[^a-zA-Z0-9]+/', '', CoreInterface::SAFE_SYMBOLS);
        $done = false;
        $size = true ? 12 : 36;

        $client = new Client();

        do {
            $slug = $client->formattedId($alphabet, $size);

            if (!Message::slug($slug)->exists()) {
                $done = true;
            }
        } while(!$done);

        $message->slug = $slug;
        $message->slug_password = bcrypt($client->formattedId($alphabet, 8));
    }

    /**
     * Handle the message "created" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        //
    }

    /**
     * Handle the message "updated" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function updated(Message $message)
    {
        //
    }

    /**
     * Handle the message "deleted" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function deleted(Message $message)
    {
        //
    }

    /**
     * Handle the message "restored" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function restored(Message $message)
    {
        //
    }

    /**
     * Handle the message "force deleted" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function forceDeleted(Message $message)
    {
        //
    }
}
