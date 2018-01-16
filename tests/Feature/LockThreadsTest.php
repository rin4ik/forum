<?php

namespace Tests\Feature;

use Tests\TestCase;

class LockThreadsTest extends TestCase
{
    /** @test */
    public function non_administrators_may_not_lock_threads()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $this->post(route('locked-threads.store', $thread), ['locked' => true, ])->assertStatus(403);
        $this->assertFalse(!!$thread->fresh()->locked);
    }

    /** @test */
    public function administrators_can_lock_threads()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $this->post(route('locked-threads.store', $thread), ['locked' => true, ])->assertStatus(200);
        $this->assertTrue($thread->fresh()->locked, 'Failed asserting that the thread was locked');
    }

    /** @test */
    public function administrators_can_unlock_threads()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        $thread = create('App\Thread', ['user_id' => auth()->id(), 'locked' => true]);
        $this->delete(route('locked-threads.destroy', $thread));
        $this->assertFalse($thread->fresh()->locked);
    }

    /** @test */
    public function once_locked_a_thread_may_not_receive_new_replies()
    {
        $this->signIn();
        $thread = create('App\Thread', ['locked' => true]);
        $thread->lock();
        $this->assertTrue($thread->locked);
        $this->post($thread->path() . '/replies', ['body' => 'Foobar', 'user_id' => create('App\User')->id
       ])->assertStatus(422);
    }
}
