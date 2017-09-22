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

        $this->user = factory(User::class)->create();
        $this->thread = factory(Thread::class)->create();
        $this->reply = factory(Reply::class)->make();
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
        $this->be($this->user);

        $this->post('/threads/'.$this->thread->id.'/replies', $this->reply->toArray());

        $this->get('/threads/'.$this->thread->id)
            ->assertSee($this->reply->body);
    }
}
