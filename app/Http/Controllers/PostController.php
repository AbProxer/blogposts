<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

public function index()
{
    $dataPath = storage_path('app/data/posts.json');
    //$path = Storage::path('data/posts.json');
    

    if (File::exists($dataPath)) {
        
        $postsJsonPath = json_decode(File::get($dataPath), true);
        
        return response()->json($postsJsonPath);

    } else {
        return ["message"=>"No posts json file found"];
    }
    
}

public function getPost($postId)
{
    $dataPath = storage_path('app/data/posts.json');

    if (File::exists($dataPath)) {
        $postsJsonData = json_decode(File::get($dataPath), true);

        // Loop through the posts to find the one with the matching ID
        foreach ($postsJsonData as $post) {
            if (isset($post['id']) && $post['id'] == $postId) {
                return response()->json($post);
            }
        }

        // If no post with the given ID is found, return a 404 response
        return response()->json(["message" => "Post not found"], 404);
    } else {
        return response()->json(["message" => "No posts JSON file found"], 404);
    }
}


public function store(Request $request)
{
    $newPost = $request->all();

    $postsJsonPath = storage_path('app/data/posts.json');

    if (File::exists($postsJsonPath)) {
        $posts = json_decode(File::get($postsJsonPath), true);
    } else {
        $posts = [];
    }

    // Add the new post to the array
    $posts[] = $newPost;

    // Save the updated array back to the JSON file
    File::put($postsJsonPath, json_encode($posts, JSON_PRETTY_PRINT));

    return response()->json(
        [
            'message' => 'Post created successfully',
            'data' => $newPost
        ],
    201
    );
}

public function destroy($id)
{
    $postsJsonPath = storage_path('app/data/posts.json');

    if (File::exists($postsJsonPath)) {
        $posts = json_decode(File::get($postsJsonPath), true);
    } else {
        $posts = [];
    }

    // Search for the post with the specified ID
    $postIndex = null;
    foreach ($posts as $index => $post) {
        if (isset($post['id']) && $post['id'] == $id) {
            $postIndex = $index;
            break;
        }
    }

    // Check if the post with the specified ID was found
    if ($postIndex !== null) {
        // Remove the post from the array
        array_splice($posts, $postIndex, 1);

        // Save the updated array back to the JSON file
        File::put($postsJsonPath, json_encode($posts, JSON_PRETTY_PRINT));

        return response()->json(['message' => 'Post deleted successfully'], 200);
    } else {
        return response()->json(['message' => 'Post not found'], 404);
    }
}


}
