<?php

namespace Tests\Unit;

use Tests\TestCase;

class ReplyTest extends TestCase
{
    
    /** @test*/
    public function it_has_an_owner()
    {
        $reply=factory('App\Reply')->create();
        $this->assertInstanceOf('App\User', $reply->owner);
    }
}
