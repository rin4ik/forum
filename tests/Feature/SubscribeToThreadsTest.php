<?php

namespace Tests\Feature;

use Tests\TestCase;

class SubscribeToThreadsTest extends TestCase
{
    /**
    * @test */
    public function a_user_can_subscribe_to_threads()
    {
        $this->signIn();
        $thread = create('App\Thread');

        $this->post($thread->path() . '/subscriptions');
        $thread->addReply([
        'user_id' => auth()->id(),
        'body' => 'Some reply here'
       ]);
    }
}
