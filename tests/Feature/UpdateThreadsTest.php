<?php

namespace Tests\Feature;

use Tests\TestCase;

class UpdateThreadsTest extends TestCase
{
    public function setup()
    {
        parent::setUp();
        $this->withExceptionHandling();
        $this->signIn();
    }

    /** @test */
    public function a_thread_requires_a_title_and_body_to_be_updated()
    {
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $this->patch($thread->path(), [
        'title' => 'Changed'
    ])->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauthorized_users_may_not_update_threads()
    {
        $thread = create('App\Thread', ['user_id' => create('App\User')->id]);
        $this->patch($thread->path(), [
        'title' => 'Changed',
        'body' => 'sdas'
    ])->assertStatus(403);
    }

    /** @test */
    public function a_thread_can_be_updated_by_its_creator()
    {
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Changed',
           'body' => 'Changed body.'
        ]);

        tap($thread->fresh(), function ($thread) {
            $this->assertEquals('Changed', $thread->title);
            $this->assertEquals('Changed body.', $thread->body);
        });
    }
}
