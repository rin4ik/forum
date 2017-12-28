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
        $this->be($user = factory('App\User')->create());
        $thread = create('App\Thread');
        $reply = make('App\Reply');
        $this->post($thread->path() . '/replies', $reply->toArray());
        $this->assertDatabaseHas('replies', ['body' => $reply->body]);
        $this->assertEquals(1, $thread->fresh()->replies_count);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);
        $this->post($thread->path() . '/replies', $reply->toArray())
        ->assertSessionHasErrors('body');
    }

    /**
     * @test
     */
    public function unauthorized_users_cannot_delete_replies()
    {
        $this->withExceptionHandling();
        $reply = create('App\Reply');
        $this->delete("replies/{$reply->id}")
            ->assertRedirect('login');
        $this->signIn();
        $this->delete("/replies/{$reply->id}")
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function authorized_users_can_delete_replies()
    {
        $this->signIn();
        $reply = create('App\Reply', ['user_id' => auth()->id()]);

        $this->delete("/replies/{$reply->id}")->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, $reply->thread->fresh()->replies_count);
    }

    /**
     * @test
     */
    public function authorized_users_can_update_threads()
    {
        $this->signIn();
        $reply = create('App\Reply', ['user_id' => auth()->id()]);
        $this->patch("/replies/{$reply->id}", ['body' => 'You have been changed, fool']);
        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => 'You have been changed, fool']);
    }

    /**
    * @test
    */
    public function unauthorized_users_cannot_update_replies()
    {
        $this->withExceptionHandling();
        $reply = create('App\Reply');
        $this->patch("/replies/{$reply->id}", ['body' => 'You have been changed, fool'])
        ->assertRedirect('/login');
        $this->signIn();
        $this->patch("/replies/{$reply->id}")->assertStatus(403);
    }

    /**
    * @test
    */
    public function replies_that_contain_spam_may_not_be_created()
    {
        $this->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply', [
            'body' => 'Yahoo Customer Support'
        ]);
        $this->expectException(\Exception::class);
        $this->post($thread->path() . '/replies', $reply->toArray());
    }
}
