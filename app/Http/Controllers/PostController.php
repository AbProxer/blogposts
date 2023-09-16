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

        // Check if the post with the given ID exists in the JSON data
        if (isset($postsJsonData[$postId])) {
            $post = $postsJsonData[$postId-1];
            return response()->json($post);
        } else {
            return response()->json(["message" => "Post not found"], 404);
        }
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

    return response()->json(['message' => 'Post created successfully']);
}

public function destroy($id)
{
    $postsJsonPath = storage_path('app/data/posts.json');

    if (File::exists($postsJsonPath)) {
        $posts = json_decode(File::get($postsJsonPath), true);
    } else {
        $posts = [];
    }

    // Check if the post with the specified ID exists
    if (isset($posts[$id])) {
        // Remove the post from the array
        unset($posts[$id-1]);

        // Reindex the array
        $posts = array_values($posts);

        // Save the updated array back to the JSON file
        File::put($postsJsonPath, json_encode($posts, JSON_PRETTY_PRINT));

        return response()->json(['message' => 'Post deleted successfully']);
    } else {
        return response()->json(['message' => 'Post not found'], 404);
    }
}

}
