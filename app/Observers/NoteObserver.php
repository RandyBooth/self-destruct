<?php

namespace App\Observers;

use App\Note;
use Hidehalo\Nanoid\Client;
use Hidehalo\Nanoid\CoreInterface;

class NoteObserver
{
    /**
     * Handle the note "creating" event.
     *
     * @param  \App\Note  $note
     * @return void
     */
    public function creating(Note $note)
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

            if (!Note::slug($slug)->exists()) {
                $is_done = true;
            }
        } while(!$is_done);

        $note->slug = $slug;
        $note->slug_password = $client->formattedId(
            $alphabet,
            $size_password
        );
        $note->password = ($note->password)
            ? bcrypt($note->password)
            : null;
        logger()->info($note->slug . '@' . $note->slug_password);
    }

    /**
     * Handle the note "created" event.
     *
     * @param  \App\Note  $note
     * @return void
     */
    public function created(Note $note)
    {
        //
    }

    /**
     * Handle the note "updated" event.
     *
     * @param  \App\Note  $note
     * @return void
     */
    public function updated(Note $note)
    {
        //
    }

    /**
     * Handle the note "deleting" event.
     *
     * @param  \App\Note  $note
     * @return void
     */
    public function deleting(Note $note)
    {
        if (!is_null($note->expired_at)) {
            if (now()->diffInSeconds($note->expired_at, false) > 0) {
                return false;
            }
        }
    }

    /**
     * Handle the note "deleted" event.
     *
     * @param  \App\Note  $note
     * @return void
     */
    public function deleted(Note $note)
    {
        //
    }

    /**
     * Handle the note "restored" event.
     *
     * @param  \App\Note  $note
     * @return void
     */
    public function restored(Note $note)
    {
        //
    }

    /**
     * Handle the note "force deleted" event.
     *
     * @param  \App\Note  $note
     * @return void
     */
    public function forceDeleted(Note $note)
    {
        //
    }
}
