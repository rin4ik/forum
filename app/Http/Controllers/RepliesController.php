<?php

namespace App\Http\Controllers;

use App\Thread;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store($replyId, Thread $thread)
    {
        $this->validate(request(), ['body'=>'required']);
  
        $thread->addReply([
            'body'=>request('body'),
            'user_id'=>auth()->id()
        ]);
        return back();
    }
}
