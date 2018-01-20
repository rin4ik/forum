<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(\App\Trending $trending)
    {
        $search = request('q');
        $threads = \App\Thread::search($search)->paginate(25);

        if (request()->expectsJson()) {
            return $threads;
        }
        return view('threads.index', [
            'threads' => $threads,
            'trending' => $trending->get()
        ]);
    }
}
