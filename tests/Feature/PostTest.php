<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function it_can_create_a_post()
    {
        $response = $this->postJson('/api/posts', [
            'title' => 'Sample Post',
            'content' => 'This is a sample post.',
            'author' => 'John Doe',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'data' => [
                         'title' => 'Sample Post',
                         'content' => 'This is a sample post.',
                         'author' => 'John Doe',
                     ],
                 ]);
    }
}
