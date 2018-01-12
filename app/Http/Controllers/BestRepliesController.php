<?php

namespace App\Http\Controllers;

use App\Reply;

class BestRepliesController extends Controller
{
    public function store(Reply $reply)
    {
        // abort_if($reply->thread->user_id !== auth()->id(), 401);
        $this->authorize('update', $reply->thread);
        $reply->thread->markBestReply($reply);
        // update(['best_reply_id' => $reply->id]);
    }
}
