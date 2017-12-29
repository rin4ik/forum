<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;
use App\Inspections\Spam;

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

    public function store($replyId, Thread $thread, Spam $spam)
    {
        $this->validate(request(), ['body' => 'required']);
        $spam->detect(request('body'));
        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);
        if (request()->expectsJson()) {
            return $reply->load('owner');
        }

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

    public function update(Reply $reply, Spam $spam)
    {
        $this->authorize('update', $reply);
        $this->validate(request(), ['body' => 'required']);
        $spam->detect(request('body'));

        $reply->update(request(['body']));
    }
}
