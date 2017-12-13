<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Activity;

class CreateThreadsTest extends TestCase
{
    /** @test */
    public function unanthenticated_users_may_not_add_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
        ->assertRedirect('/login');

        $this->post('/threads')
        ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();
        $thread = make('App\Thread');
        $response = $this->post('/threads', $thread->toArray());
        $this->get($response->headers->get('Location'))
        ->assertSee($thread->title)
        ->assertSee($thread->body);
    }

    /** @test */
    public function thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
        ->assertSessionHasErrors('title');
    }

    /** @test */
    public function thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
        ->assertSessionHasErrors('body');
    }

    /** @test */
    public function thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();
        $this->publishThread(['channel_id' => null])
        ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 9929])
        ->assertSessionHasErrors('channel_id');
    }

    /** @test */
    public function unanthenticated_users_may_not_delete_threads()
    {
        $this->withExceptionHandling();
        $thread = create('App\Thread');
        $this->delete($thread->path())->assertRedirect('/login');
        $this->signIn();
        $this->delete($thread->path())->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_threads()
    {
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);
        $favorite = create('App\Favorite', ['favorited_id' => $reply->id]);
        $response = $this->json('DELETE', $thread->path());
        $response->assertStatus(204);
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertDatabaseMissing('favorites', ['id' => $favorite->id]);
        $this->assertDatabaseMissing(
            'activities',
         ['subject_id' => $thread->id,
          'subject_type' => get_class($thread)
     ]
        );
        $this->assertDatabaseMissing(
            'activities',
         ['subject_id' => $reply->id,
          'subject_type' => get_class($reply)
     ]
        );
        $this->assertDatabaseMissing(
            'activities',
         ['subject_id' => $favorite->id,
          'subject_type' => get_class($favorite)
     ]
        );
        $this->assertEquals(0, Activity::count());
    }

    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread', $overrides);

        return $this->post('threads', $thread->toArray());
        // ->assertSessionHasErrors('title');
    }
}
