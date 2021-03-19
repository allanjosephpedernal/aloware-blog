<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    // test store comment resouce
    public function testStoreComment()
    {
        // post comment
        $response = $this->post('/comment', [
            'username' => 'Sample Username',
            'post_id' => 1,
            'reply_id' => 0,
            'content' => 'Sample Content'
        ]);

        // assert status to 201
        $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'message'=>'Comment is successfully added!'
        ]);
    }
}
