<?php

namespace App\Listeners;

use App\Events\ChirpCreated;
use App\Models\User;
use App\Notifications\NewChirp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChirpCreatedNotifications implements ShouldQueue // The ShouldQueue interface tells Laravel that the listener should be run in a queue.
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * 
     * @param ChirpCreated $event The event of the Chirp creation.
     * @return void
     */
    public function handle(ChirpCreated $event): void
    {
        // Gets all users except the creator of the new Chirp.
        // Uses a cursor to avoid loading every user into memory at once.
        $usersCursor = User::whereNot('id', $event->chirp->user_id)->cursor();

        // Notify users about the new Chirp.
        foreach ($usersCursor as $user) {
            $user->notify(new NewChirp($event->chirp)); // TODO: Implement "following" feature.
        }

        // Note: In a production application you should add the ability for your users to unsubscribe from notifications like these.
    }
}
