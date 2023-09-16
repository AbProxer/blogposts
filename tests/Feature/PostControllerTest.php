<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
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
            'post' => $faker->paragraph,
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

}
