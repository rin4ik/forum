<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(\App\Trending $trending)
    {
        if (request()->expectsJson()) {
            $search = request('q');
            return \App\Thread::search($search)->paginate(25);
        }
        return view('threads.search', [
            'trending' => $trending->get()
        ]);
    }
}
