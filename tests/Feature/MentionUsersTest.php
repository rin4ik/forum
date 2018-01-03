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
     *  */
    public function it_can_detect_all_mentioned_users_in_the_body()
    {
        $reply = make('App\Reply', [
            'body' => '@JaneDoe :  you are @john an asshole'
        ]);
        $this->assertEquals(['JaneDoe', 'john'], $reply->mentionedUsers());
    }
}
