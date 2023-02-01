<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        if ( isset($data['cover_image']) ) {
            $data['cover_image'] = Storage::put('uploads', $data['cover_image']);
        }

        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Str::slug($new_post->title);
        $new_post->save();

        if( isset($data['tags']) ) {
            $new_post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index')->with('message', "Il Post $new_post->title è stato creato con successo!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {   
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        $old_title = $post->title;

        $post->slug = Str::slug($data['title']);

        if ( isset($data['cover_image']) ) {
            if( $post->cover_image ) {
                Storage::delete($post->cover_image);
            }
            $data['cover_image'] = Storage::put('uploads', $data['cover_image']);
        }

        if( isset($data['no_image']) && $post->cover_image  ) {
            Storage::delete($post->cover_image);
            $post->cover_image = null;
        }

        $post->update($data);

        $tags = isset($data['tags']) ? $data['tags'] : [];
        $post->tags()->sync($tags);

        return redirect()->route('admin.posts.index')->with('message', "Il post $old_title è stato aggiornato!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $old_title = $post->title;

        if( $post->cover_image ) {
            Storage::delete($post->cover_image);
        }
        
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', "Il post $old_title è stato cancellato!");
    }
}
