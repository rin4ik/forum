<?php

namespace App;

use Illuminate\Support\Facades\Redis;

class Visits
{
    protected $thread;

    /**
     * visits contructor
     *
     * @param [type] $thread
     * @return void
     */
    public function __construct($thread)
    {
        $this->thread = $thread;
    }

    public function record()
    {
        Redis::incr($this->cacheKey());
        return $this;
    }

    public function reset()
    {
        Redis::del($this->cacheKey());

        return $this;
    }

    public function count()
    {
        return Redis::get($this->cacheKey()) ?? 0;
    }

    protected function cacheKey()
    {
        return "threads.{$this->thread->id}.visits";
    }
}
