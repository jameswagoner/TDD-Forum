<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var User $user
     */
    public $user;

    /**
     * @var Thread $thread
     */
    public $thread;

    /**
     * @var Reply $reply
     */
    public $reply;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create(Thread::class);
        $this->reply = make(Reply::class);
    }

    /** @test */
    public function an_unauthenticated_user_may_not_participate_in_forum_threads()
    {
        $this->expectException(AuthenticationException::class);

        $this->post('/threads/1/replies', []);
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();

        $this->post($this->thread->path() . '/replies', $this->reply->toArray());

        $this->get($this->thread->path())
            ->assertSee($this->reply->body);
    }
}
