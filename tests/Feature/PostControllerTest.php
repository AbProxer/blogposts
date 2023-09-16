<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\File;
use Faker\Factory as Faker;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use WithFaker;

    public function test_Index_response_has_provided_json_structure()
    {

        $this->artisan('storage:link');
        $response = $this->get('/api/posts');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'title',
                    'subtitle',
                    'post',
                    'tags',
                    'author',
                    'interviewee'
                ],
            ]);
    }

    public function test_post_has_been_stored_successfully()
    {

        $faker = Faker::create();

        $postData = [
            'id' => $faker->uuid,
            'title' => $faker->sentence,
            'subtitle' => $faker->sentence,
            'post' => $faker->paragraph(16),
            'tags' => $faker->words(3, true),
            'author' => $faker->name,
            'interviewee' => $faker->name
        ];

        $response = $this->json('POST', '/api/post', $postData);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Post created successfully',
                'data' => $postData,
            ]);
    }

    public function test_post_deleted_successfully()
    {
        $postsJsonPath = storage_path('app/data/posts.json');
        $posts = json_decode(File::get($postsJsonPath), true);

        if (!empty($posts)) {
            $randomPost = $posts[array_rand($posts)];
            $postId = $randomPost['id'];
        }

        $response = $this->json('DELETE', "/api/post/{$postId}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Post deleted successfully',
            ]);

        $this->assertPostDeleted($postId);
    }

    protected function assertPostDeleted($postId)
    {
        $postsJsonPath = storage_path('app/data/posts.json');

        if (file_exists($postsJsonPath)) {
            $posts = json_decode(file_get_contents($postsJsonPath), true);

            foreach ($posts as $post) {
                if (isset($post['id']) && $post['id'] == $postId) {
                    $this->fail("Post with ID {$postId} was not deleted.");
                }
            }
        }
    }
}
