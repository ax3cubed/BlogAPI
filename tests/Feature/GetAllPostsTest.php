<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAllPostsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_get_all_posts_without_errors()
    {
        // Create some posts
        $posts = Post::factory()->count(5)->create();

        // Send a GET request to the endpoint
        $response = $this->getJson('/api/posts');


        $response->assertStatus(200);


        $response->assertJsonFragment([
            'title' => $posts->first()->title,
            'content' => $posts->first()->content,
            'author' => $posts->first()->author,
        ]);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'content',
                    'author',
                    'publish_at',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }
}
