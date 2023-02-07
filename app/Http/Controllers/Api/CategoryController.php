<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::has('posts')->get();
    }

    public function show($slug)
    {
        try {
            return Category::where('slug', $slug)->with('posts.tags')->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'error' => '404 Category not found'
            ], 404);
        }
    }
}
