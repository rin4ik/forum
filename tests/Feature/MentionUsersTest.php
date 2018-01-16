<?php

namespace Tests\Feature;

use Tests\TestCase;

class MentionUsersTest extends TestCase
{
    /**
     * @test
     */
    public function mentioned_users_in_a_reply_are_notified()
    {
        $john = create('App\User', ['name' => 'JohnDoe']);
        $this->signIn();
        $jane = create('App\User', ['name' => 'JaneDoe']);
        $thread = create('App\Thread');
        $reply = make('App\Reply', [
            'body' => '@JaneDoe you @john are an asshole'
        ]);
        $this->json('post', $thread->path() . '/replies', $reply->toArray());
        $this->assertCount(1, $jane->notifications);
    }


    /**
     * @test
     */
    public function it_can_fetch_all_users_starting_with_the_given_characters()
    {
        create('App\User', ['name' => 'john']);
        create('App\User', ['name' => 'jane']);
        create('App\User', ['name' => 'john2']);
        $ma = $this->json('GET', '/api/users', ['name' => 'john']);
        $this->assertCount(2, $ma->json());
    }
}
