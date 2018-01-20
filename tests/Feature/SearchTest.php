<?php

namespace Tests\Feature;

use Tests\TestCase;

class SearchTest extends TestCase
{
    /** @test */
    public function a_user_can_search_threads()
    {
        config(['scout.driver' => 'algolia']);
        $search = 'foobar';
        create('App\Thread', [], 2);
        create('App\Thread', ['body' => "A thread with the {$search} term."], 2);
        do {
            sleep(.40);
            $results = $this->getJson("/threads/search?q={$search}")->json()['data'];
        } while (empty($results));
        $this->assertCount(2, $results);
        \App\Thread::latest()->take(4)->unsearchable();
    }
}
