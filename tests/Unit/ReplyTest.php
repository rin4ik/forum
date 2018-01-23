<?php

namespace Tests\Unit;

use Tests\TestCase;
use Carbon\Carbon;

class ReplyTest extends TestCase
{
    /** @test*/
    public function it_has_an_owner()
    {
        $reply = factory('App\Reply')->create();
        $this->assertInstanceOf('App\User', $reply->owner);
    }

    /** @test*/
    public function it_knows_if_it_was_just_published()
    {
        $reply = create('App\Reply');
        $this->assertTrue($reply->wasJustPublished());
        $reply->created_at = Carbon::now()->subMonth();
        $this->assertFalse($reply->wasJustPublished());
    }

    /**
     * @test
     *  */
    public function it_can_detect_all_mentioned_users_in_the_body()
    {
        $reply = new \App\Reply([
            'body' => '@JaneDoe :  you are @john an asshole'
        ]);
        $this->assertEquals(['JaneDoe', 'john'], $reply->mentionedUsers());
    }

    /** @test*/
    public function it_wraps_usernames_in_the_body_within_anchor_tags()
    {
        $reply = new \App\Reply([
            'body' => 'Hello @Jane-Doe.'
        ]);
        $this->assertEquals('Hello <a href="/profiles/Jane-Doe">@Jane-Doe</a>.', $reply->body);
    }

    /** @test */
    public function it_knows_if_it_is_the_best_reply()
    {
        $reply = create('App\Reply');
        $this->assertFalse($reply->isBest());
        $reply->thread->update(['best_reply_id' => $reply->id]);
        $this->assertTrue($reply->fresh()->isBest());
    }

    /** @test */
    public function a_replies_body_is_sanitized_automatically()
    {
        $reply = make('App\Reply', ['body' => '<script>alert("bad")</script><p>This is ok</p>']);
        $this->assertEquals($reply->body, '<p>This is ok</p>');
    }
}
