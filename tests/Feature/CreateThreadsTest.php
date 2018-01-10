<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Activity;
use App\Thread;
class CreateThreadsTest extends TestCase
{
    /** @test */
    public function unanthenticated_users_may_not_add_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
        ->assertRedirect(route('login'));

        $this->post(route('threads'))
        ->assertRedirect(route('login'));
    }
    /** @test */
    public function new_users_must_fist_confirm_their_email_address_before_creating_threads()
    {
        $user=factory('App\User')->states('unconfirmed')->create();
        $this->signIn($user);
        $thread = make('App\Thread');

        $this->post(route('threads'),$thread->toArray())
        ->assertRedirect(route('threads'))
        ->assertSessionHas('flash','You must first confirm your email address');
    }
    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
     
        $this->signIn();

        $thread = make('App\Thread');
        $response = $this->post(route('threads'), $thread->toArray());
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
public function a_thread_requires_a_unique_slug()
{
    $this->signIn();

    $thread=create('App\Thread',['title'=>'Foo title','slug'=>'foo-title']);
    $this->assertEquals($thread->fresh()->slug, 'foo-title');
    $this->post(route('threads'),$thread->toArray());
    $this->assertTrue(Thread::whereSlug('foo-title-2')->exists());
    $this->post(route('threads'),$thread->toArray());
    $this->assertTrue(Thread::whereSlug('foo-title-3')->exists());
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

        return $this->post(route('threads'), $thread->toArray());
        // ->assertSessionHasErrors('title');
    }
}
