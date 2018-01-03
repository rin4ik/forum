<?php

namespace App\Listeners;

use App\User;
use App\Notifications\YouWereMentioned;
use App\Events\ThreadReceivedNewReply;

class NotifyMentionedUsers
{
    /**
     * Handle the event.
     *
     * @param  ThreadReceivedNewReply  $event
     * @return void
     */
    public function handle(ThreadReceivedNewReply $event)
    {
        // preg_match_all('/\@([^\s\.]+)/', $event->reply->body, $matches);
        collect($event->reply->mentionedUsers())
        ->map(function ($name) {
            return User::whereName($name)->first();
        })
        ->filter()
        ->each(function ($user) use ($event) {
            $user->notify(new YouWereMentioned($event->reply));
        });
    }
}
