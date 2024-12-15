<?php

namespace App\Listeners;

use App\Events\FriendRequestAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\FriendRequestAcceptedNotification;

class NotifyFriendRequestAccepted
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
    public function handle(FriendRequestAccepted $event): void
    {
        \Log::info('Sending friend request accepted to receiver:', ['receiver' => $event->receiver]);
        $event->receiver->notify(new FriendRequestAcceptedNotification($event->sender));
    }
}
