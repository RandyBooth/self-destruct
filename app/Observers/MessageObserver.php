<?php

namespace App\Observers;

use App\Message;
use Hidehalo\Nanoid\Client;

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
        $alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $client = new Client();
        $message->slug = $client->formattedId($alphabet, 12);
        // for premium user
        // $message->slug = $client->formattedId($alphabet, 36);
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
