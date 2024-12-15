<?php

namespace App\Listeners;

use App\Events\FriendRequestSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\FriendRequestNotification;

class NotifyFriendRequestReceived
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
     */
    public function handle(FriendRequestSent $event): void
    {
        \Log::info('Sending notification to receiver:', ['receiver' => $event->receiver]);
        $event->receiver->notify(new FriendRequestNotification($event->sender));
    }
}
