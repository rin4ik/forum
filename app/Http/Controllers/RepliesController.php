<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;
use App\User;
use App\Http\Requests\CreatePostRequest;
use App\Notifications\YouWereMentioned;

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
        $reply = $thread->addReply([
                'body' => request('body'),
                'user_id' => auth()->id()
            ]);
        preg_match_all('/\@([^\s\.]+)/', $reply->body, $matches);

        foreach ($matches[1] as $name) {
            $user = User::whereName($name)->first();
            if ($user) {
                $user->notify(new YouWereMentioned($reply));
            }
        }
        return $reply->load('owner');

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
        try {
            \request()->validate(['body' => 'required|spamfree']);

            $reply->update(request(['body']));
        } catch (\Exception $e) {
            return response('Sorry, your reply could not be saved', 422);
        }
    }
}
