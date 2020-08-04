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
        $is_done = false;
        $size = true ? 12 : 24; // 12, 24, 36
        $size_password = true ? 8 : 12;

        $client = new Client();

        do {
            $slug = $client->formattedId(
                $alphabet,
                $size
            );

            if (!Message::slug($slug)->exists()) {
                $is_done = true;
            }
        } while(!$is_done);

        $message->slug = $slug;
        $message->slug_password = $client->formattedId(
            $alphabet,
            $size_password
        );
        $message->password = ($message->password)
            ? bcrypt($message->password)
            : null;
        logger()->info($message->slug . '@' . $message->slug_password);
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
     * Handle the message "deleting" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function deleting(Message $message)
    {
        if (!is_null($message->expired_at)) {
            if (now()->diffInSeconds($message->expired_at, false) > 0) {
                return false;
            }
        }
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
