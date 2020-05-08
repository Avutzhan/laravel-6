<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_can_be_liked()
    {
        $this->actingAs(factory(User::class)->create());

        $post = factory(Post::class)->create();

        $post->like();

        $this->assertCount(1, $post->likes);
        $this->assertTrue($post->likes->contains('id', auth()->id()));
    }

    /** @test */
    public function a_comment_can_be_liked()
    {
        $this->actingAs(factory(User::class)->create());

        $comment = factory(Comment::class)->create();

        $comment->like();

        $this->assertCount(1, $comment->likes);
    }
}

//vendor/bin/phpunit tests/Feature/LikePostsTest.php  this to run tests
//before dont forget to install phpunit tests
//and dont forget to comment in test /** @test */ phpstorm dont understand that is a test
