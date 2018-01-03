<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;
use App\Http\Requests\CreatePostRequest;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->orderBy('created_at', 'desc')->paginate(20);
    }

    public function store($replyId, Thread $thread, CreatePostRequest $form)
    {
        return $thread->addReply([
                'body' => request('body'),
                'user_id' => auth()->id()
            ])->load('owner');

        return back()
        ->with('flash', 'Your reply has been left');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted!']);
        }
        return back();
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        request()->validate(['body' => 'required|spamfree']);

        $reply->update(request(['body']));
    }
}
