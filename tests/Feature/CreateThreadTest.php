<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var User $user
     */
    protected $user;

    /**
     * @var Thread $thread
     */
    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->thread = factory(Thread::class)->make();
    }

    /** @test */
    public function an_unauthenticated_user_cannot_create_new_forum_threads()
    {
        $this->expectException(AuthenticationException::class);

        $this->post('/threads', []);
    }

    /** @test */
    public function an_authenticate_user_can_create_new_forum_threads()
    {
        $this->actingAs($this->user);

        $this->post('/threads', $this->thread->toArray());

        $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }
}
