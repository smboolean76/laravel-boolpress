<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewComment;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:150',
            'content' => 'required|string'
        ]);

        $data = $request->all();

        $new_comment = new Comment();
        $new_comment->name = $data['name'];
        $new_comment->content = $data['content'];
        $new_comment->post_id = $post->id;
        $new_comment->save();

        if( $new_comment ) {
            Mail::to('info@boolpress.it')->send(new NewComment($new_comment));
        }

        return $new_comment;
    }
}
