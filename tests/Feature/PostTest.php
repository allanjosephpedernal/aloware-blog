<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    // test get post comment
    public function testGetPostComment()
    {
        // get post comment
        $response = $this->get('/post/comment/1');

        // assert status to 200
        $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message'=>'Loaded result successfully!'
        ]);
    }

    // set show resource
    public function testShow()
    {
        // get post
        $response = $this->get('/post/1');

        // assert status to 200
        $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message'=>'Loaded result successfully!'
        ]);
    }
}
