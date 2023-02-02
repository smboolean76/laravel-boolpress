<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'tags')->get();

        return $posts;
    }

    public function show($slug)
    {
        try {
            $post = Post::where('slug', $slug)->with('category', 'tags')->firstOrFail();
            return $post;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'error' => '404 Post not found'
            ], 404);
        }

        return $post;
    }
}
