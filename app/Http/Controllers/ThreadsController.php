<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use App\Channel;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;
use Illuminate\Support\Facades\Redis;
use App\Trending;

class ThreadsController extends Controller
{
   /**
    * Threads constructor
    */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

/**
 * display a listing of the resourse
 *
 * @param Channel $channel
 * @param ThreadFilters $filters
 * @param Trending $trending
 * @return void
 */
    public function index(Channel $channel, ThreadFilters $filters, Trending $trending)
    {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }
        return view('threads.index',
        ['threads'=>$threads,
        'trending'=>$trending->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        request()->validate([
            'title' => 'required|spamfree',
            'body' => 'required|spamfree',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'slug'=>str_slug(request('title')),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);
        return redirect($thread->path())
        ->with('flash', 'Your thread has been published!');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer     $channelId
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channel, Thread $thread,Trending $trending)
    {
        if (auth()->check()) {
            auth()->user()->read($thread);
        }
        $trending->push($thread);
       // $thread->visits()->record();
       $thread->increment('visits'); 
       return view('threads.show', compact('thread'));
    }

    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();
        // $thread->replies()->delete();
        //Reply::where('thread_id', $thread->id)->delete();
        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/threads')
        ->with('flash', 'You have deleted a thread');
    }

    /**
     * Fetch all relevant threads.
     *
     * @param Channel       $channel
     * @param ThreadFilters $filters
     * @return mixed
     */
    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::filter($filters)->latest();
        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }
        return $threads->paginate(10);
    }
}
