<?php

namespace Tests\Feature;

use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
 
    /** @test */
    public function unanthenticated_users_may_not_add_replies()
    {
        $this->withExceptionHandling()
        ->post('/threads/sad/1/replies', [])
        ->assertRedirect('/login');
    }
    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user =factory('App\User')->create());
        $thread=create('App\Thread');
        $reply=make('App\Reply');
        $this->post($thread->path().'/replies', $reply->toArray());
        $this->get($thread->path())
        ->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();
        $thread=create('App\Thread');
        $reply=make('App\Reply', ['body'=>null]);
        $this->post($thread->path().'/replies', $reply->toArray())
        ->assertSessionHasErrors('body');
    }
}
